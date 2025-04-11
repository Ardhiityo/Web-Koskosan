@extends('layouts.app')

@section('title', 'All Great Koskos')

@section('content')
    <div id="Background"
        class="absolute top-0 w-full h-[570px] rounded-b-[75px] bg-[linear-gradient(180deg,#F2F9E6_0%,#D2EDE4_100%)]">
    </div>
    <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
        <a href="{{ route('home') }}"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white">
            <img src="{{ asset('assets/images/icons/arrow-left.svg') }}" class="w-[28px] h-[28px]" alt="icon">
        </a>
        <p class="font-semibold">Browse Koskosan</p>
        <div class="dummy-btn w-12"></div>
    </div>
    <div id="Header" class="relative flex items-center justify-between gap-2 px-5 mt-[18px]">
        <div class="flex flex-col gap-[6px]">
            <h1 class="font-bold text-[32px] leading-[48px]">All Koskosan</h1>
            <p class="text-ngekos-grey">{{ $boardingHouses->count() }} Kos Available</p>
        </div>
        <button class="flex flex-col items-center text-center shrink-0 rounded-[22px] p-[10px_20px] gap-2 bg-white">
            <img src="{{ asset('assets/images/icons/star.svg') }}" class="w-6 h-6" alt="icon">
            <p class="font-bold text-sm">
                @php
                    $boardingHouseRatings = [];
                    foreach ($boardingHouses as $boardingHouse) {
                        $boardingHouseRatings[] = $boardingHouse->testimonials->avg('rating');
                    }
                    $result = array_sum($boardingHouseRatings) / count($boardingHouseRatings);
                @endphp
                {{ floor($result) }}/5
            </p>
        </button>
    </div>
    <section id="Result" class=" relative flex flex-col gap-4 px-5 mt-5 mb-9">
        @foreach ($boardingHouses as $boardingHouse)
            <a href="{{ route('room-detail', ['slug' => $boardingHouse->slug]) }}" class="card">
                <div
                    class="flex rounded-[30px] border border-[#F1F2F6] p-4 gap-4 bg-white hover:border-[#91BF77] transition-all duration-300">
                    <div class="flex w-[120px] h-[183px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                        <img src="{{ asset('storage/' . $boardingHouse->thumbnail) }}" class="w-full h-full object-cover"
                            alt="icon">
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <h3 class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">
                            {{ $boardingHouse->name }}</h3>
                        <hr class="border-[#F1F2F6]">
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-5 h-5 flex shrink-0"
                                alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $boardingHouse->city->name }}</p>
                        </div>
                        <div class="flex items-center gap-[6px]">
                            <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-5 h-5 flex shrink-0"
                                alt="icon">
                            <p class="text-sm text-ngekos-grey">{{ $boardingHouse->rooms->sum('capacity') }} People</p>
                        </div>
                        <hr class="border-[#F1F2F6]">
                        <p class="font-semibold text-lg text-ngekos-orange">
                            <span class="text-sm">Start from</span> <br>
                            Rp.
                            {{ number_format($boardingHouse->rooms->min('price_per_month'), thousands_separator: '.') }}<span
                                class="text-sm text-ngekos-grey font-normal">/month</span>
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
    </section>
@endsection
