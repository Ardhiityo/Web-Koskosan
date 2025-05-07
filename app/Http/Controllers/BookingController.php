<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Illuminate\Http\Request;
use App\Services\Interface\CityService;
use App\Services\Interface\RoomService;
use App\Services\Interface\CategoryService;
use App\Http\Requests\CustomerBookingRequest;
use App\Http\Requests\MyBookingDetailRequest;
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
        return view(view: 'pages.check-booking');
    }

    public function bookingRoomSave(Request $request)
    {
        $this->transactionRepository->savedDataToSession($request->all());

        return redirect()->route('booking-room');
    }

    public function bookingRoom()
    {
        $transaction = $this->transactionRepository->getDataFromSession();

        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseById($transaction['boarding_house_id']);
        $room = $this->roomRepository->getRoomById($transaction['room_id']);

        return view(
            view: 'pages.booking.room',
            data: compact('boardingHouse', 'room')
        );
    }

    public function bookingDetail(CustomerBookingRequest $request)
    {
        $this->transactionRepository->savedDataToSession($request->validated());

        $transaction = $this->transactionRepository->getDataFromSession();

        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseById($transaction['boarding_house_id']);
        $room = $this->roomRepository->getRoomById($transaction['room_id']);
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

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$clientKey = config('midtrans.client_key');
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

        try {
            $paymentUrl = Snap::getSnapToken($params);

            return response()->json([
                'token' => $paymentUrl
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function success()
    {
        $order = $this->transactionRepository
            ->getTransactionByCode($this->transactionRepository->getDataFromSession()['code']);

        return view(
            view: 'pages.booking.success',
            data: compact('order')
        );
    }

    public function myBookingDetail(MyBookingDetailRequest $request)
    {
        $data = $request->validated();
        $order = $this->transactionRepository->getTransactionByCode($data['booking_code']);

        return view(
            view: 'pages.booking.my-booking',
            data: compact('order')
        );
    }
}
