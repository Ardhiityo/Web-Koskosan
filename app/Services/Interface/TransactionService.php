<?php

namespace App\Services\Interface;

interface TransactionService
{
    public function __construct(RoomService $roomRepository);
    public function savedDataToSession(array $data);
    public function getDataFromSession();
    public function subTotal();
    public function tax();
    public function insurance();
    public function downPayment();
    public function grandTotalFullPayment();
    public function grandTotalDownPayment();
    public function generateTransactionCode();
    public function totalAmountByPaymentMethod($paymentMethod);
    public function createTransaction($paymentMethod);
}
