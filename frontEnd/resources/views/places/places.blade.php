@extends('layouts.app')
@section('content')
    <style>
        @media (max-width: 576px) {
            body {
                background-color: #212529;
            }

            .placesDiv {
                justify-content: center;
                border: none !important;
                width: 100vw !important;
                border-radius: 0 !important;
            }
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9ejmUZ74ZX8eoeu2OIw20l6A-wW93fjI"></script>
    <div class="container-fluid">
        <div class="placesDiv container col-12 col-sm-12 col-md-9 col-lg-8 col-xl-7">
            <h2>{{__('views.places')}}</h2>
            <div class="d-flex">
                {!! Form::open(['route' => 'places.searchPlace', 'method' => 'get', 'class'=> 'd-flex']) !!}
                {!! Form::text('query', null, ['placeholder' => __('views.search'), 'class' => 'form-control']) !!}
                {!! Form::submit(__('views.search'), ['class' => 'btn btn-primary ms-2']) !!}
                {!! Form::close() !!}
                <a type="text" href="{{route('places.addPlace')}}"
                   class="ms-auto btn btn-success">{{__('views.addPlace')}}</a>
            </div>
            <div class="border rounded mt-1">
                @foreach($places as $place)
                    <div class="bg-light border rounded m-2 p-1">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <img alt="" class="flagIcon border img-fluid" style="width: 50px; height: 30px;"
                                     src="{{asset('/assets/flags/'.$place->country->country_image)}}">
                                <div class="ms-2">
                                    <b>{{$place->city_name}}</b>
                                    ({{$place->postcode}})
                                    <br>
                                    <small>{{$place->street_name}}</small>
                                </div>
                            </div>
                            @if($place->isAccepted)
                                <a class="btn btn-success ms-auto me-1"><i class="bi bi-check-circle"></i></a>
                            @else
                                <a class="btn btn-warning ms-auto me-1"><i class="bi bi-clock"></i></a>
                            @endif
                            <div id="map-{{$place->id}}" class="w-25"></div>
                        </div>
                    </div>
                    <script>
                        {{--function initMap{{$place->id}}() {
                            @foreach($places as $plc)
                            let center{{$plc->id}} = {lat: {{$plc->latitude}}, lng: {{$plc->longitude}}};
                            let map{{$plc->id}} = new google.maps.Map(document.getElementById('map-{{$plc->id}}'), {
                                zoom: 14,
                                center: center{{$plc->id}},
                            });
                            let marker{{$plc->id}} = new google.maps.Marker({
                                position: center{{$plc->id}},
                                map: map{{$plc->id}}
                            });
                            @endforeach
                        }

                        window.onload = initMap{{$place->id}};--}}
                    </script>
                @endforeach
            </div>
        </div>
    </div>
@endsection
