@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-sm-3 d-flex justify-content-center">
            <a href="{{ route('catalog', ['id' => 'commemorative']) }}"
               class="commemorativeImage m-3 col-md-3 col-sm-6 col-8 border border-3 border-dark rounded text-decoration-none text-dark">
                <h5 class="mt-2 fw-bold">
                    {{ __('views.commemorative') }} <br>
                    @auth()
                        {{$collectionCount['commemorative'] ?? '0'}}/{{$countComm}}
                    @endauth
                </h5>
            </a>
            <a href="{{ route('catalog', ['id' => 'circulation']) }}"
               class="circulationBg m-3 col-md-3 col-sm-6 border col-8 border-3 border-dark rounded text-decoration-none text-dark">
                <h5 class="mt-2 fw-bold">
                    {{ __('views.circulation') }} <br>
                    @auth()
                        {{$collectionCount['circulation'] ?? '0'}}/{{$countCirc}}
                    @endauth
                </h5>
            </a>
            <a href="{{route('users')}}"
               class="usersBg bg-white m-3 col-md-3 col-sm-6 col-8 border border-3 border-dark rounded text-decoration-none text-dark">
                <h5 class="mt-2 fw-bold">
                    {{ __('views.users') }}
                </h5>
            </a>
            @auth()
                <a href="{{route('statistics')}}"
                   class="statisticsIcon m-3 col-md-3 col-sm-6 col-8 border border-3 border-dark rounded text-decoration-none text-dark">
                    <h5 class="mt-2 fw-bold">
                        {{ __('views.statistics') }}
                    </h5>
                </a>
                <a href="{{route('places.places')}}"
                   class="swapBg m-3 col-md-3 col-sm-6 col-8 border border-3 border-dark rounded text-decoration-none text-dark">
                    <h5 class="mt-2 fw-bold">
                        {{ __('views.places') }}
                    </h5>
                </a>
            @endauth
            <a href="/shop"
               class="shopBg bg-white m-3 col-md-3 col-sm-6 col-8 border border-3 border-dark rounded text-decoration-none text-dark">
                <h5 class="mt-2 fw-bold">
                    {{ __('views.shop') }}
                </h5>
            </a>
        </div>
        <div class="d-flex justify-content-center">
            <a href="https://www.instagram.com/mycoins.es"
               class="rounded-circle border border-3 border-dark bg-white p-1 m-1">
                <img src="{{ asset('/assets/icons/instagram.png') }}" alt="">
            </a>
            <a href="https://www.tiktok.com/@mycoins.es"
               class="rounded-circle border border-3 border-dark bg-white p-1 m-1">
                <img src="{{ asset('/assets/icons/tiktok.png') }}" alt="">
            </a>
        </div>
    </div>
@endsection
