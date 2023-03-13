<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function places()
    {
        return view("/places/places",
            ["countries" => Coin::join('countries', 'coins.country_id', '=', 'countries.id')
                ->select('countries.country_name', 'countries.id')->distinct()->pluck('country_name', 'id'),
                "places" => Place::all()]);
    }

    public function searchPlace(Request $request)
    {
        return view("/places",
            ["countries" => Coin::join('countries', 'coins.country_id', '=', 'countries.id')
                ->select('countries.country_name', 'countries.id')->distinct()->pluck('country_name', 'id'),
                "places" => Place::all()]);
    }

    public function addPlace()
    {
        return view("/places/addPlace", ["countries" => Coin::join('countries', 'coins.country_id', '=', 'countries.id')
            ->select('countries.country_name', 'countries.id')->distinct()->pluck('country_name', 'id')]);
    }

    public function store(Request $request)
    {
        $place = new Place;
        $place->city_name = $request->city_name;
        $place->postcode = $request->postcode;
        $place->street_name = $request->street_name;
        $place->country_id = $request->selectCountry;
        $place->latitude = $request->latitude;
        $place->longitude = $request->longitude;
        $place->save();

        $countries = Coin::join('countries', 'coins.country_id', '=', 'countries.id')
            ->select('countries.country_name', 'countries.id')
            ->distinct()
            ->pluck('country_name', 'id');

        $places = Place::all();

        return redirect()->route('places.places')->with(compact('countries', 'places'));
    }
}
