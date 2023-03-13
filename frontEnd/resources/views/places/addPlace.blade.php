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
            <div class="mt-1">
                <form action="{{route('places.store')}}" method="POST">
                    @csrf
                    <div>
                        <label for="city_name" class="mt-3 fw-bold">{{ __('views.cityName') }}</label>
                        <input class="form-control" type="text" name="city_name" id="city_name">
                        <label for="postcode" class="mt-3 fw-bold">{{ __('views.postcode') }}</label>
                        <input class="form-control" type="number" name="postcode" id="postcode">
                        <label for="street_name" class="mt-3 fw-bold">{{ __('views.streetName') }}</label>
                        <input class="form-control" type="text" name="street_name" id="street_name">
                        <label for="country_id" class="mt-3 fw-bold">{{ __('auth.country') }}</label>
                        <div class="mb-1">
                            {!! Form::select('selectCountry', $countries, null,['class' => 'form-select', 'placeholder' => __('views.selectCountry')]) !!}
                        </div>
                    </div>
                    <div id="map" class="d-flex justify-content-center" style="height: 300px;"></div>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <div class="d-flex justify-content-center mt-1">
                        <button type="submit" class="btn btn-success">{{__('views.addPlace')}}</button>
                    </div>
                </form>
            </div>

            <script>
                // Initialize the map
                let map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                    center: {lat: 40.4378698, lng: -3.8196208}
                });

                // Add a marker for the selected location
                let marker = new google.maps.Marker({
                    map: map,
                    position: {lat: 40.4378698, lng: -3.8196208},
                    draggable: true
                });

                // Update the latitude and longitude fields when the marker is moved
                google.maps.event.addListener(marker, 'dragend', function () {
                    document.getElementById('latitude').value = marker.getPosition().lat();
                    document.getElementById('longitude').value = marker.getPosition().lng();
                });
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        let pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        map.setCenter(pos);
                        marker.setPosition(pos);
                    });
                }
            </script>
        </div>
    </div>
@endsection
