<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

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

        Log::info($transaction, ['35']);

        $sid    = config('twilio.sid');
        $token  = config('twilio.token');
        $twilio = new Client($sid, $token);

        $price = number_format($transaction->total_amount, thousands_separator: '.');

        $message = <<<MESSAGE
        Terima kasih 🙏
        Pembayaran kamu sudah kami terima.

        Booking code : $transaction->code
        Customer : $transaction->name
        Email : $transaction->email
        Phone : $transaction->phone_number
        Tanggal Lunas : $transaction->transaction_date
        Total dibayarkan : Rp. $price

        Ini adalah layanan pesan otomatis dan tidak perlu dibalas.
        MESSAGE;

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

                $twilio->messages
                    ->create(
                        "whatsapp:+$transaction->phone_number",
                        array(
                            "from" => "whatsapp:+14155238886",
                            "body" => $message
                        )
                    );

                break;
            case 'default':
                $transaction->update(['payment_status' => 'pending']);
                break;
        }

        return response(content: ['message' => 'Callback received succesfully'], status: 200);
    }
}
