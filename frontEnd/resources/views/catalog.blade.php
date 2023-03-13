@php
    use App\Models\Collection;
@endphp
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex">
            <div class="searchDiv col-2 ms-5 me-5 border rounded">
                <h5 class="mt-2 d-flex justify-content-center fw-bold">@lang('views.filter')</h5>
                {!! Form::open(['route' => 'coins.selectCoin']) !!}
                <div class="align-content-between">
                    {!! Form::select('countrySelect', $countrySelect, request()->input('countrySelect'), ['class' => 'form-select', 'onchange' => 'form.submit()','placeholder' => __('views.allCountries')]) !!}
                    {!! Form::select('typeSelect', $typeSelect, request()->input('typeSelect'), ['class' => 'form-select', 'onchange' => 'form.submit()']) !!}
                    {!! Form::select('yearSelect', $yearSelect, request()->input('yearSelect'), ['class' => 'form-select', 'onchange' => 'form.submit()','placeholder' => __('views.allYears')]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div
                class="text-center coinsDiv bg-dark text-white justify-content-center col-12 col-sm-8 row border rounded overflow-auto">
                @if(count($coins) <= 0)
                    <h1 class="mt-2">@lang('views.noCoins')</h1>
                @else
                    @foreach($coins as $coin)
                        <div class="col-4 col-sm-4 col-md-3 col-lg-2 col-xl-2 border rounded m-3"
                             id="coinBg-{{$coin->id}}">
                            <div class="d-flex">
                                <img class="mt-2 w-25 h-100 me-auto border border-secondary"
                                     src="{{asset('assets/flags/'.$coin->country->country_image)}}" alt="">
                                @auth()
                                    <a href="{{route('addToMyCollection', ['coin_id' =>$coin->id, 'year' => $coin->year[0]])}}"
                                       data-bs-target="#flush-collapseOne{{$coin->id}}" data-bs-toggle="collapse">
                                        @if(Collection::where('coin_id', $coin->id)->where('year', $coin->year[0])->where('user_id',auth()->id())->count() !==0)
                                            <script>
                                                document.getElementById("coinBg-{{$coin->id}}").style.backgroundColor = 'gray';
                                            </script>
                                            <i class="text-warning bi bi-star-fill"></i>
                                        @else
                                            <i class="text-white bi bi-star"></i>
                                        @endif
                                    </a>
                                @endauth
                            </div>
                            <small>{{$coin->name}}</small>
                            <div class="d-flex justify-content-center">
                                <img src="{{asset('/assets/coins/'.$coin->image)}}" alt=""
                                     class="w-75 m-3 img-fluid rounded-circle align-items-end">
                            </div>
                            @auth
                                <div id="flush-collapseOne{{$coin->id}}" class="accordion-collapse collapse">
                                    <div>
                                        @foreach($coin->year as $year)
                                            <div class="d-flex mb-1">
                                                <small class="mt-1">{{$year}}</small>
                                                <a href="{{route('addToMyCollection', ['coin_id' =>$coin->id, 'year' => $year])}}"
                                                   class="ms-auto">
                                                    @if(Collection::where('coin_id', $coin->id)->where('year', $year)->where('user_id',auth()->id())->count() !==0)
                                                        <i class="text-warning bi bi-star-fill"></i>
                                                    @else
                                                        <i class="text-white bi bi-star"></i>
                                                    @endif
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endauth
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mt-2">
                            {{$coins->links()}}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
