@extends('layouts.app')

@section('title', 'Koskosan')

@section('content')
    <div id="Background"
        class="absolute top-0 w-full h-[280px] rounded-bl-[75px] bg-[linear-gradient(180deg,#F2F9E6_0%,#D2EDE4_100%)]">
    </div>

    <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
        <div class="flex flex-col gap-1">
            <p>Find your ideal stay in a click,</p>
            <h1 class="font-bold text-xl leading-[30px]">Discover and settle easily.</h1>
        </div>
    </div>

    <div id="Categories" class="swiper w-full overflow-x-hidden mt-[30px]">
        <div class="swiper-wrapper">

            @foreach ($categories as $category)
                <div class="swiper-slide !w-fit pb-[30px]">
                    <a href="{{ route('category', ['slug' => $category->slug]) }}" class="card">
                        <div
                            class="flex flex-col items-center w-[120px] shrink-0 rounded-[40px] p-4 pb-5 gap-3 bg-white shadow-[0px_12px_30px_0px_#0000000D] text-center">
                            <div class="w-[70px] h-[70px] rounded-full flex shrink-0 overflow-hidden">
                                <img src="{{ asset('storage/' . $category->image) }}" class="w-full h-full object-cover"
                                    alt="thumbnail">
                            </div>
                            <div class="flex flex-col gap-[2px]">
                                <h3 class="font-semibold">{{ $category->name }}</h3>
                                <p class="text-sm text-ngekos-grey">{{ $category->boardingHouses->count() }} Kos</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>

    <section id="Popular" class="flex flex-col gap-4">
        <div class="flex items-center justify-between px-5">
            <h2 class="font-bold">Popular Kos</h2>
            <a href="{{ route('popular') }}">
                <div class="flex items-center gap-2">
                    <span>See all</span>
                    <img src="{{ asset('assets/images/icons/arrow-right.svg') }}" class="w-6 h-6 flex shrink-0"
                        alt="icon">
                </div>
            </a>
        </div>
        <div class="swiper w-full overflow-x-hidden">
            <div class="swiper-wrapper">

                @foreach ($popularBoardingHouses as $popularBoardingHouse)
                    <div class="swiper-slide !w-fit">
                        <a href="{{ route('room-detail', ['slug' => $popularBoardingHouse->slug]) }}" class="card">
                            <div
                                class="flex flex-col w-[250px] shrink-0 rounded-[30px] border border-[#F1F2F6] p-4 pb-5 gap-[10px] hover:border-[#91BF77] transition-all duration-300">
                                <div class="flex w-full h-[150px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                                    <img src="{{ asset('storage/' . $popularBoardingHouse->thumbnail) }}"
                                        class="w-full h-full object-cover" alt="thumbnail">
                                </div>
                                <div class="flex flex-col gap-3">
                                    <h3 class="font-semibold text-lg leading-[27px] line-clamp-2 min-h-[54px]">
                                        {{ $popularBoardingHouse->name }}</h3>
                                    <hr class="border-[#F1F2F6]">
                                    <div class="flex items-center gap-[6px]">
                                        <img src="{{ asset('assets/images/icons/location.svg') }}"
                                            class="w-5 h-5 flex shrink-0" alt="icon">
                                        <p class="text-sm text-ngekos-grey">{{ $popularBoardingHouse->city->name }}</p>
                                    </div>
                                    <div class="flex items-center gap-[6px]">
                                        <img src="{{ asset('assets/images/icons/3dcube.svg') }}"
                                            class="w-5 h-5 flex shrink-0" alt="icon">
                                        <p class="text-sm text-ngekos-grey">In {{ $popularBoardingHouse->category->name }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-[6px]">
                                        <img src="{{ asset('assets/images/icons/profile-2user.svg') }}"
                                            class="w-5 h-5 flex shrink-0" alt="icon">
                                        <p class="text-sm text-ngekos-grey">
                                            {{ $popularBoardingHouse->rooms()->sum('capacity') }}
                                            People
                                        </p>
                                    </div>
                                    <hr class="border-[#F1F2F6]">
                                    <p class="font-semibold text-lg text-ngekos-orange">
                                        <span class="text-sm">Start from</span> <br>
                                        Rp.
                                        {{ number_format(num: $popularBoardingHouse->rooms->min('price_per_month'), thousands_separator: '.') }}<span
                                            class="text-sm text-ngekos-grey font-normal">/month</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <section id="Cities" class="flex flex-col p-5 gap-4 bg-[#F5F6F8] mt-[30px]">
        <div class="flex items-center justify-between">
            <h2 class="font-bold">Browse Cities</h2>
            <a href="{{ route('cities') }}">
                <div class="flex items-center gap-2">
                    <span>See all</span>
                    <img src="{{ asset('assets/images/icons/arrow-right.svg') }}" class="w-6 h-6 flex shrink-0'"
                        alt="icon">
                </div>
            </a>
        </div>
        <div class="grid grid-cols-2 gap-4">

            @foreach ($cities as $city)
                <a href="{{ route('city', ['slug' => $city->slug]) }}" class="card">
                    <div
                        class="flex items-center rounded-[22px] p-[10px] gap-3 bg-white border border-white overflow-hidden hover:border-[#91BF77] transition-all duration-300">
                        <div
                            class="w-[55px] h-[55px] flex shrink-0 rounded-full border-4 border-white ring-1 ring-[#F1F2F6] overflow-hidden">
                            <img src="{{ asset('storage/' . $city->image) }}" class="w-full h-full object-cover"
                                alt="icon">
                        </div>
                        <div class="flex flex-col gap-[2px]">
                            <h3 class="font-semibold">{{ $city->name }}</h3>
                            <p class="text-sm text-ngekos-grey">{{ $city->boardingHouses->count() }} Kos</p>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </section>
    <section id="Best" class="flex flex-col gap-4 px-5 mt-[30px]">
        <div class="flex items-center justify-between">
            <h2 class="font-bold">All Great Koskosan</h2>
            <a href="{{ route('all-boardingHouse') }}">
                <div class="flex items-center gap-2">
                    <span>See all</span>
                    <img src="{{ asset('assets/images/icons/arrow-right.svg') }}" class="w-6 h-6 flex shrink-0"
                        alt="icon">
                </div>
            </a>
        </div>
        <div class="flex flex-col gap-4">
            @foreach ($boardingHouses as $boardingHouse)
                <a href="{{ route('room-detail', ['slug' => $boardingHouse->slug]) }}" class="card">
                    <div
                        class="flex rounded-[30px] border border-[#F1F2F6] p-4 gap-4 bg-white hover:border-[#91BF77] transition-all duration-300">
                        <div class="flex w-[120px] h-[183px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                            <img src="{{ asset('storage/' . $boardingHouse->thumbnail) }}"
                                class="w-full h-full object-cover" alt="icon">
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
                                <img src="{{ asset('assets/images/icons/profile-2user.svg') }}"
                                    class="w-5 h-5 flex shrink-0" alt="icon">
                                <p class="text-sm text-ngekos-grey">
                                    {{ $boardingHouse->rooms->sum('capacity') }} People</p>
                            </div>
                            <hr class="border-[#F1F2F6]">
                            <p class="font-semibold text-lg text-ngekos-orange">
                                <span class="text-sm">Start from</span> <br>
                                Rp.
                                {{ number_format(num: $boardingHouse->rooms->min('price_per_month'), thousands_separator: '.') }}<span
                                    class="text-sm text-ngekos-grey font-normal">/month</span>
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    @include('includes.nav')
@endsection
