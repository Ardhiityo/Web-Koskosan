<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interface\CityService;
use App\Services\Interface\RoomService;
use App\Services\Interface\CategoryService;
use App\Services\Interface\BoardingHouseService;
use App\Services\Interface\TransactionService;

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

        $transaction = $this->transactionRepository->getDataFromSession();
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseById($transaction['boardingHouse']);
        $room = $this->roomRepository->getRoomById($transaction['room']);

        return view('pages.booking.booking-room', compact('boardingHouse', 'room'));
    }

    public function bookingDetail(Request $request)
    {
        $this->transactionRepository->savedDataToSession($request->all());

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
            view: 'pages.booking.booking-detail',
            data: compact('boardingHouse', 'room', 'subTotal', 'tax', 'insurance', 'grandTotalFullPayment', 'grandTotalDownPayment', 'transaction', 'subTotalDownPayment')
        );
    }

    public function checkout(Request $request)
    {
        $this->transactionRepository->createTransaction($request->payment_method);
    }
}
