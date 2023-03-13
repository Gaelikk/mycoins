<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\CoinController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Auth::routes();

//MAIN PAGE
Route::get("/home", [HomeController::class, "index"])->name("home");
Route::get("/menu", [MenuController::class, "all"]);
Route::redirect("/", "menu");

//FALLBACK
Route::fallback(function () {
    return redirect()->back();
});

//CHANGE LANGUAGE
Route::get("locale/{id}", function ($locale) {
    Session::put("locale", $locale);
    return redirect()->back();
});

//AUTHENTICATED PAGES
Route::group(["middleware" => "auth"], function () {
    //CODE VIEWS
    Route::group(["prefix" => "profile"], function () {
        Route::get("/", [ProfileController::class, "profile"])->name('profile');
        Route::get("/delete/{id}", [ProfileController::class, "delete"])->name("profile.delete");
        Route::post("/update/{id}", [ProfileController::class, "update"])->name("profile.update");
    });
    Route::get('/addToMyCollection/{coin_id}/{year}', [CoinController::class, 'addToMyCollection'])->name('addToMyCollection');
    Route::group(["prefix" => "places"], function () {
        Route::get("/places", [PlaceController::class, "places"])->name('places.places');
        Route::get("/searchPlace", [PlaceController::class, "searchPlace"])->name('places.searchPlace');
        Route::get("/addPlace", [PlaceController::class, "addPlace"])->name('places.addPlace');
        Route::post("/store", [PlaceController::class, "store"])->name('places.store');
    });
    Route::get("/statistics", [StatController::class, "statistics"])->name('statistics');

});
//NO AUTHENTICATED PAGES
//USERS
Route::group(["prefix" => "users"], function () {
    Route::get("/", [UserController::class, "all"])->name('users');
    Route::get("/detailedUser/{id}", [UserController::class, "detailedUser"])->name("users.detailedUser");
    Route::get("/delete/{id}", [UserController::class, "delete"])->name("users.delete");
});

//COINS
Route::get("/catalog/{id}", [CoinController::class, "catalog"])->name("catalog");
Route::post("/selectCoin", [CoinController::class, "selectCoin"])->name('coins.selectCoin');
Route::post("/selectCountry", [UserController::class, "selectCountry"])->name('users.selectCountry');

