@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-center">
        <div
            class="coinsDiv d-flex justify-content-center text-center bg-dark text-white col-12 col-sm-8 row border rounded">
            <div class="titleBar">
                <small class="fs-5 ps-3 pe-3 bg-dark">{{ __('views.totalCollection') }}</small>
            </div>
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 col-xl-2 border rounded m-3 me-auto ms-auto">
                <div class="mt-2 row d-flex justify-content-center">
                    <span>{{$totalCoinsUser}}/{{$totalCoins}}</span>
                    <div class="single-chart w-75">
                        <svg viewBox="0 0 36 36" class="circular-chart m-2">
                            <path class="circle-bg"
                                  d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="circle"
                                  d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  stroke-dasharray="{{round(($totalCoinsUser*100)/$totalCoins)}}, 100"/>
                            <text x="18" y="20.35" class="percentage">{{round(($totalCoinsUser*100)/$totalCoins)}}%
                            </text>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="titleBar">
                <small class="fs-5 ps-3 pe-3 bg-dark">{{ __('views.nations') }}</small>
            </div>
            @foreach($countries as $country)
                <div class="col-4 col-sm-4 col-md-3 col-lg-2 col-xl-2 border rounded m-3">
                    <div class="mt-1">
                        <img src="{{asset('/assets/flags/'.$country->country_image)}}" alt=""
                             class="w-25 img-fluid" title="{{$country->country_name}}">
                    </div>
                    <div class="d-flex row justify-content-center">
                        <span>{{$country->coinCountUser ?? 0}}/{{$country->coinCount}}</span>
                        <div class="single-chart w-75">
                            <svg viewBox="0 0 36 36" class="circular-chart m-2">
                                <path class="circle-bg"
                                      d="M18 2.0845
                                  a 15.9155 15.9155 0 0 1 0 31.831
                                  a 15.9155 15.9155 0 0 1 0 -31.831"/>
                                <path class="circle"
                                      d="M18 2.0845
                                  a 15.9155 15.9155 0 0 1 0 31.831
                                  a 15.9155 15.9155 0 0 1 0 -31.831"
                                      stroke-dasharray="{{$country->coinCountUser ? round(($country->coinCountUser*100)/$country->coinCount): 0}}, 100"/>
                                <text x="18" y="20.35"
                                      class="percentage">{{round(($country->coinCountUser*100)/$country->coinCount)}}%
                                </text>
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
