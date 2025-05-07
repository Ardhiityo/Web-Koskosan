<?php

namespace App\Services\Repositories;

use App\Models\Transaction;
use Illuminate\Support\Facades\Date;
use App\Services\Interface\RoomService;
use App\Services\Interface\TransactionService;

class TransactionRepository implements TransactionService
{
    public function __construct(private RoomService $roomRepository) {}

    public function savedDataToSession(array $data)
    {
        return session()->put('transaction', $data);
    }

    public function getDataFromSession()
    {
        return session('transaction');
    }

    public function subTotal()
    {
        $transaction = $this->getDataFromSession();
        $room = $this->roomRepository->getRoomById($transaction['room_id']);

        return $transaction['duration'] * $room->price_per_month;
    }

    public function tax()
    {
        return $this->subTotal() * 0.11;
    }

    public function insurance()
    {
        return $this->subTotal() * 0.01;
    }

    public function downPayment()
    {
        return $this->subTotal() * 0.30;
    }

    public function grandTotalFullPayment()
    {
        return $this->subTotal() + $this->tax() + $this->insurance();
    }

    public function grandTotalDownPayment()
    {
        return $this->downPayment() + $this->tax() + $this->insurance();
    }

    public function generateTransactionCode()
    {
        return 'KOS' . strval(random_int(1000, 100000000));
    }

    public function totalAmountByPaymentMethod($paymentMethod)
    {
        return $paymentMethod == 'full_payment' ? $this->grandTotalFullPayment() : $this->grandTotalDownPayment();
    }

    public function createTransaction($paymentMethod)
    {
        $transaction = $this->getDataFromSession();

        return Transaction::create([
            'code' => $this->generateTransactionCode(),
            'boarding_house_id' => $transaction['boarding_house_id'],
            'room_id' => $transaction['room_id'],
            'name' => $transaction['name'],
            'email' => $transaction['email'],
            'phone_number' => $transaction['phone_number'],
            'payment_method' => $paymentMethod,
            'payment_status' => 'pending',
            'start_date' => $transaction['start_date'],
            'duration' => $transaction['duration'],
            'total_amount' => $this->totalAmountByPaymentMethod($paymentMethod),
            'transaction_date' => Date::now()->toDateString()
        ]);
    }

    public function getTransactionByCode($code)
    {
        try {
            return Transaction::with(
                ['boardingHouse' => ['city', 'category'], 'room']
            )->where('code', $code)->firstOrFail();
        } catch (\Throwable $th) {
            return abort(404);
        }
    }
}
