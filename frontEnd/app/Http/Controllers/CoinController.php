<?php
namespace App\Http\Controllers;
use App\Models\Coin;
use App\Models\Collection;
use App\Models\Year;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class CoinController extends Controller
{
    public function catalog($id): Factory|View|Application
    {
        return view("/catalog",
            ["coins" => Coin::where('type', $id)->paginate(15),
                "countrySelect" => Coin::join('countries', 'coins.country_id', '=', 'countries.id')
                    ->select('countries.country_name', 'countries.id')->distinct()->pluck('country_name', 'id'),
                "typeSelect" => Coin::select('type')->distinct()->pluck('type'),
                "yearSelect" => Year::pluck('year', 'id')]);
    }

    public function addToMyCollection($coin_id, $year)
    {
        $saveColl = Collection::where('coin_id', $coin_id)->where('year', $year)->where('user_id', auth()->id());
        ($saveColl->count() !== 0) ? $saveColl->delete() : Collection::create(['coin_id' => $coin_id, 'year' => $year, 'user_id' => auth()->id()]);
        return redirect()->back();
    }
    public function selectCoin(Request $request)
    {
        $cs = $request->countrySelect;
        $ts = $request->typeSelect;
        $ts = $ts == 0 ? 'circulation' : 'commemorative';
        $ys = $request->yearSelect;
        $query = Coin::query();
        $query->join('countries', 'countries.id', '=', 'coins.country_id');
        if ($cs) {
            $query->where('country_id', $cs)->where('type', $ts);
        }
        if ($ys) {
            $year = Year::find($ys);
            $query->whereJsonContains('year', $year->year)->where('type', $ts);
        }
        $query->where('type', $ts);
        $coins = $query->paginate(15);

        return view("/catalog",
            ["coins" => $coins,
                "countrySelect" => Coin::join('countries', 'coins.country_id', '=', 'countries.id')
                    ->select('countries.country_name', 'countries.id')->distinct()->pluck('country_name', 'id'),
                "typeSelect" => Coin::select('type')->distinct()->pluck('type')->toArray(),
                "yearSelect" => Year::pluck('year', 'id'),
                "ts" => $ts]);
    }
}
