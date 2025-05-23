@extends('layouts.app')

@section('title', 'Booking detail')

@section('content')
    <div id="Background"
        class="absolute top-0 w-full h-[230px] rounded-b-[75px] bg-[linear-gradient(180deg,#F2F9E6_0%,#D2EDE4_100%)]">
    </div>
    <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
        <a href="{{ route('booking-room') }}"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white">
            <img src="{{ asset('assets/images/icons/arrow-left.svg') }}" class="w-[28px] h-[28px]" alt="icon">
        </a>
        <p class="font-semibold">Checkout Koskos</p>
        <div class="dummy-btn w-12"></div>
    </div>
    <div id="Header" class="relative flex items-center justify-between gap-2 px-5 mt-[18px]">
        <div class="flex flex-col w-full rounded-[30px] border border-[#F1F2F6] p-4 gap-4 bg-white">
            <div class="flex gap-4">
                <div class="flex w-[120px] h-[132px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                    <img src="{{ asset('assets/images/thumbnails/details-1.png') }}" class="w-full h-full object-cover"
                        alt="icon">
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <p class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">{{ $boardingHouse->name }}</p>
                    <hr class="border-[#F1F2F6]">
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-5 h-5 flex shrink-0"
                            alt="icon">
                        <p class="text-sm text-ngekos-grey">{{ $boardingHouse->city->name }} City</p>
                    </div>
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-5 h-5 flex shrink-0"
                            alt="icon">
                        <p class="text-sm text-ngekos-grey">In {{ $boardingHouse->category->name }}</p>
                    </div>
                </div>
            </div>
            <hr class="border-[#F1F2F6]">
            <div class="flex gap-4">
                <div class="flex w-[120px] h-[156px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                    <img src="{{ asset('assets/images/thumbnails/room-1.png') }}" class="w-full h-full object-cover"
                        alt="icon">
                </div>
                <div class="flex flex-col gap-3 w-full">
                    <p class="font-semibold text-lg leading-[27px]">{{ $room->name }}</p>
                    <hr class="border-[#F1F2F6]">
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-5 h-5 flex shrink-0"
                            alt="icon">
                        <p class="text-sm text-ngekos-grey">{{ $boardingHouse->capacity }} People</p>
                    </div>
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('assets/images/icons/3dcube.svg') }}" class="w-5 h-5 flex shrink-0"
                            alt="icon">
                        <p class="text-sm text-ngekos-grey">{{ $room->square_feet }} square feet</p>
                    </div>
                    <hr class="border-[#F1F2F6]">
                    <p class="font-semibold text-lg text-ngekos-orange">Rp
                        {{ number_format($room->price_per_month, thousands_separator: '.') }}<span
                            class="text-sm text-ngekos-grey font-normal">/month</span></p>
                </div>
            </div>
        </div>
    </div>
    <div
        class="accordion group flex flex-col rounded-[30px] p-5 bg-[#F5F6F8] mx-5 mt-5 overflow-hidden has-[:checked]:!h-[68px] transition-all duration-300">
        <label class="relative flex items-center justify-between">
            <p class="font-semibold text-lg">Customer</p>
            <img src="{{ asset('assets/images/icons/arrow-up.svg') }}"
                class="w-[28px] h-[28px] flex shrink-0 group-has-[:checked]:rotate-180 transition-all duration-300"
                alt="icon">
            <input type="checkbox" class="absolute hidden">
        </label>
        <div class="flex flex-col gap-4 pt-[22px]">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-6 h-6 flex shrink-0"
                        alt="icon">
                    <p class="text-ngekos-grey">Name</p>
                </div>
                <p class="font-semibold">{{ $transaction['name'] }}</p>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/icons/sms.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <p class="text-ngekos-grey">Email</p>
                </div>
                <p class="font-semibold">{{ $transaction['email'] }}</p>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/icons/call.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <p class="text-ngekos-grey">Phone</p>
                </div>
                <p class="font-semibold">{{ $transaction['phone_number'] }}</p>
            </div>
        </div>
    </div>
    <div
        class="accordion group flex flex-col rounded-[30px] p-5 bg-[#F5F6F8] mx-5 mt-5 overflow-hidden has-[:checked]:!h-[68px] transition-all duration-300">
        <label class="relative flex items-center justify-between">
            <p class="font-semibold text-lg">Booking</p>
            <img src="{{ asset('assets/images/icons/arrow-up.svg') }}"
                class="w-[28px] h-[28px] flex shrink-0 group-has-[:checked]:rotate-180 transition-all duration-300"
                alt="icon">
            <input type="checkbox" class="absolute hidden">
        </label>
        <div class="flex flex-col gap-4 pt-[22px]">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/icons/clock.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <p class="text-ngekos-grey">Duration</p>
                </div>
                <p class="font-semibold">{{ $transaction['duration'] }} Months</p>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/icons/calendar.svg') }}" class="w-6 h-6 flex shrink-0"
                        alt="icon">
                    <p class="text-ngekos-grey">Started At</p>
                </div>
                <p class="font-semibold">
                    {{ \Carbon\Carbon::parse($transaction['start_date'])->translatedFormat('j F Y') }}</p>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/icons/calendar.svg') }}" class="w-6 h-6 flex shrink-0"
                        alt="icon">
                    <p class="text-ngekos-grey">Ended At</p>
                </div>
                <p class="font-semibold">
                    {{ \Carbon\Carbon::parse($transaction['start_date'])->addMonths(intval($transaction['duration']))->translatedFormat('j F Y') }}
                </p>
            </div>
        </div>
    </div>

    <form action="{{ route('booking-checkout') }}" id="booking-checkout" class="relative flex flex-col gap-6 mt-5 pt-5"
        method="POST">
        @csrf
        <div id="PaymentOptions" class="flex flex-col rounded-[30px] border border-[#F1F2F6] p-5 gap-4 mx-5">
            <div id="TabButton-Container" class="flex items-center justify-between border-b border-[#F1F2F6] gap-[18px]">
                <label class="tab-link group relative flex flex-col justify-between gap-4"
                    data-target-tab="#DownPayment-Tab">
                    <input type="radio" name="payment_method" id="payment_method" value="down_payment"
                        class="absolute -z-10 top-1/2 left-1/2 opacity-0" checked>
                    <div class="flex items-center gap-3 mx-auto">
                        <div class="relative w-6 h-6">
                            <img src="{{ asset('assets/images/icons/status-orange.svg') }}"
                                class="absolute w-6 h-6 flex shrink-0 opacity-0 group-has-[:checked]:opacity-100 transition-all duration-300"
                                alt="icon">
                            <img src="{{ asset('assets/images/icons/status.svg') }}"
                                class="absolute w-6 h-6 flex shrink-0 opacity-100 group-has-[:checked]:opacity-0 transition-all duration-300"
                                alt="icon">
                        </div>
                        <p class="font-semibold">Down Payment</p>
                    </div>
                    <div
                        class="w-0 mx-auto group-has-[:checked]:ring-1 group-has-[:checked]:ring-[#91BF77] group-has-[:checked]:w-[90%] transition-all duration-300">
                    </div>
                </label>
                <div class="flex h-6 w-[1px] border border-[#F1F2F6] mb-auto"></div>
                <label class="tab-link group relative flex flex-col justify-between gap-4"
                    data-target-tab="#FullPayment-Tab">
                    <input type="radio" name="payment_method" value="full_payment"
                        class="absolute -z-10 top-1/2 left-1/2 opacity-0">
                    <div class="flex items-center gap-3 mx-auto">
                        <div class="relative w-6 h-6">
                            <img src="{{ asset('assets/images/icons/diamonds-orange.svg') }}"
                                class="absolute w-6 h-6 flex shrink-0 opacity-0 group-has-[:checked]:opacity-100 transition-all duration-300"
                                alt="icon">
                            <img src="{{ asset('assets/images/icons/diamonds.svg') }}"
                                class="absolute w-6 h-6 flex shrink-0 group-has-[:checked]:opacity-0 transition-all duration-300"
                                alt="icon">
                        </div>
                        <p class="font-semibold">Pay in Full</p>
                    </div>
                    <div
                        class="w-0 mx-auto group-has-[:checked]:ring-1 group-has-[:checked]:ring-[#91BF77] group-has-[:checked]:w-[90%] transition-all duration-300">
                    </div>
                </label>
            </div>
            <div id="TabContent-Container">
                <div id="DownPayment-Tab" class="tab-content flex flex-col gap-4">
                    <p class="text-sm text-ngekos-grey">Anda perlu melunasi pembayaran secara cash setelah melakukan
                        survey koskos</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/card-tick.svg') }}" class="w-6 h-6 flex shrink-0"
                                alt="icon">
                            <p class="text-ngekos-grey">Payment</p>
                        </div>
                        <p class="font-semibold">Down Payment 30%</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/receipt-2.svg') }}" class="w-6 h-6 flex shrink-0"
                                alt="icon">
                            <p class="text-ngekos-grey">Sub Total</p>
                        </div>
                        <p class="font-semibold">Rp
                            {{ number_format($subTotalDownPayment, thousands_separator: '.') }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/receipt-disscount.svg') }}"
                                class="w-6 h-6 flex shrink-0" alt="icon">
                            <p class="text-ngekos-grey">PPN 11%</p>
                        </div>
                        <p class="font-semibold">Rp.
                            {{ number_format($tax, thousands_separator: '.') }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/security-user.svg') }}" class="w-6 h-6 flex shrink-0"
                                alt="icon">
                            <p class="text-ngekos-grey">Insurance</p>
                        </div>
                        <p class="font-semibold">Rp. {{ number_format($insurance, thousands_separator: '.') }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/receipt-text.svg') }}" class="w-6 h-6 flex shrink-0"
                                alt="icon">
                            <p class="text-ngekos-grey">Grand total (30%)</p>
                        </div>
                        <p id="downPaymentPrice" class="font-semibold">Rp.
                            {{ number_format($grandTotalDownPayment, thousands_separator: '.') }}
                        </p>
                    </div>
                </div>
                <div id="FullPayment-Tab" class="tab-content flex flex-col gap-4 hidden">
                    <p class="text-sm text-ngekos-grey">Anda tidak perlu memFbayar biaya tambahan apapun ketika
                        survey koskos</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/card-tick.svg') }}" class="w-6 h-6 flex shrink-0"
                                alt="icon">
                            <p class="text-ngekos-grey">Payment</p>
                        </div>
                        <p class="font-semibold">Full Payment 100%</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/receipt-2.svg') }}" class="w-6 h-6 flex shrink-0"
                                alt="icon">
                            <p class="text-ngekos-grey">Sub Total</p>
                        </div>
                        <p class="font-semibold">Rp.
                            {{ number_format($subTotal, thousands_separator: '.') }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/receipt-disscount.svg') }}"
                                class="w-6 h-6 flex shrink-0" alt="icon">
                            <p class="text-ngekos-grey">PPN 11%</p>
                        </div>
                        <p class="font-semibold">Rp.
                            {{ number_format($tax, thousands_separator: '.') }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/security-user.svg') }}" class="w-6 h-6 flex shrink-0"
                                alt="icon">
                            <p class="text-ngekos-grey">Insurance</p>
                        </div>
                        <p class="font-semibold">Rp. {{ number_format($insurance, thousands_separator: '.') }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/receipt-text.svg') }}" class="w-6 h-6 flex shrink-0"
                                alt="icon">
                            <p class="text-ngekos-grey">Grand total</p>
                        </div>
                        <p id="fullPaymentPrice" class="font-semibold">Rp.
                            {{ number_format($grandTotalFullPayment, thousands_separator: '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="BottomNav" class="relative flex w-full h-[132px] shrink-0">
            <div class="fixed bottom-5 w-full max-w-[640px] px-5 z-10">
                <div class="flex items-center justify-between rounded-[40px] py-4 px-6 bg-ngekos-black">
                    <div class="flex flex-col gap-[2px]">
                        <p id="price" class="font-bold text-xl leading-[30px] text-white">
                            <!-- Price mengikuti pilihan yang dipilih dan diambil dari text grand total -->
                        </p>
                        <span class="text-sm text-white">Grand Total</span>
                    </div>
                    <button type="submit"
                        class="flex shrink-0 rounded-full py-[14px] px-5 bg-ngekos-orange font-bold text-white">Pay
                        Now</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="{{ asset('js/app/accodion.js') }}"></script>
    <script src="{{ asset('js/app/checkout.js') }}"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        const form = document.getElementById('booking-checkout');

        form.addEventListener('submit', async function(e) {
            e.preventDefault()

            let paymentMethod = null;
            const selectedPayment = document.querySelector(
                'input[name="payment_method"]:checked'
            ).value;

            if (selectedPayment === "down_payment") {
                paymentMethod = "down_payment";
            } else if (selectedPayment === "full_payment") {
                paymentMethod = "full_payment";
            }

            try {
                getSnapToken = await fetch('{{ route('booking-checkout') }}', {
                    'method': 'POST',
                    'headers': {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json '
                    },
                    'body': JSON.stringify({
                        '_token': '{{ csrf_token() }}',
                        'payment_method': paymentMethod
                    })
                });
                const response = await getSnapToken.json();
                handlePayment(response);
            } catch (error) {
                alert('Ups something wrong');
            }
        });

        function handlePayment(result) {
            if (result.token) {
                snap.pay(result.token, {
                    onSuccess: function(result) {
                        window.location.href = '{{ route('booking-success') }}'
                    },
                    onPending: function(result) {
                        alert('Payment Pending');
                    },
                    onError: function(result) {
                        alert('Payment Error');
                    }
                });
            } else {
                alert('Ups, Try again later');
            }
        }
    </script>
@endsection
