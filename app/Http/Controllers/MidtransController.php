<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.is_server_key');
        $hashedKey = hash(
            algo: 'sha512',
            data: $request->order_id . $request->status_code . $request->gross_amount . $serverKey
        );

        if ($hashedKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        $transactionStatus = $request->transaction_status;

        $order_id = $request->order_id;

        $transaction = Transaction::where('code', $order_id)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        switch ($transactionStatus) {
            case 'capture':
                if ($request->payment_type == 'credit_card') {
                    $transaction->update(['payment_status' => 'pending']);
                } else {
                    $transaction->update(['payment_status' => 'paid']);
                }
                break;
            case 'settlement':
                $transaction->update(['payment_status' => 'paid']);
                break;
            case 'default':
                $transaction->update(['payment_status' => 'pending']);
                break;
        }

        return response(['message' => 'Callback received succesfully'], 200);
    }
}
