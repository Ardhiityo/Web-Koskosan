<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerBookingRequest;
use Illuminate\Http\Request;
use App\Services\Interface\CityService;
use App\Services\Interface\RoomService;
use App\Services\Interface\CategoryService;
use App\Services\Interface\TransactionService;
use App\Services\Interface\BoardingHouseService;

class BookingController extends Controller
{

    public function __construct(
        private CategoryService $categoryRepository,
        private BoardingHouseService $boardingHouseRepository,
        private CityService $cityRepository,
        private RoomService $roomRepository,
        private TransactionService $transactionRepository
    ) {}

    public function index()
    {
        return view('pages.check-booking');
    }

    public function roomBooking(Request $request)
    {
        $this->transactionRepository->savedDataToSession($request->all());
        return redirect()->route('room-booking-detail');
    }

    public function roomBookingDetail()
    {
        $transaction = $this->transactionRepository->getDataFromSession();

        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseById($transaction['boardingHouse']);
        $room = $this->roomRepository->getRoomById($transaction['room']);

        return view('pages.booking.room', compact('boardingHouse', 'room'));
    }

    public function bookingDetail(CustomerBookingRequest $request)
    {
        $this->transactionRepository->savedDataToSession($request->validated());

        $transaction = $this->transactionRepository->getDataFromSession();

        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseById($transaction['boardingHouse']);
        $room = $this->roomRepository->getRoomById($transaction['room']);
        $subTotal = $this->transactionRepository->subTotal();
        $tax = $this->transactionRepository->tax();
        $insurance = $this->transactionRepository->insurance();
        $subTotalDownPayment = $this->transactionRepository->downPayment();
        $grandTotalFullPayment = $this->transactionRepository->grandTotalFullPayment();
        $grandTotalDownPayment = $this->transactionRepository->grandTotalDownPayment();

        return view(
            view: 'pages.booking.detail',
            data: compact('boardingHouse', 'room', 'subTotal', 'tax', 'insurance', 'grandTotalFullPayment', 'grandTotalDownPayment', 'transaction', 'subTotalDownPayment')
        );
    }

    public function checkout(Request $request)
    {
        $order = $this->transactionRepository->createTransaction($request->payment_method);

        \Midtrans\Config::$serverKey = config('midtrans.is_server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $this->transactionRepository->savedDataToSession($order->toArray());

        $params = [
            'transaction_details' => [
                'order_id' => $order->code,
                'gross_amount' => $order->total_amount
            ],
            'customer_details' => [
                'first_name' => $order->name,
                'email' => $order->email,
                'phone' => $order->phone_number
            ]
        ];

        $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

        return redirect($paymentUrl);
    }

    public function success()
    {
        $order = $this->transactionRepository->getDataFromSession();
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseById($order['boarding_house_id']);
        $room = $this->roomRepository->getRoomById($order['room_id']);
        return view('pages.booking.success', compact('order', 'boardingHouse', 'room'));
    }
}
