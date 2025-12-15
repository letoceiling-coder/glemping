<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Filters\CityFilter;
use App\Http\Filters\MetroFilter;
use App\Http\Filters\RegionFilter;
use App\Models\City;
use App\Models\Metro;
use App\Models\Region;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    public function regions(Request $request)
    {
        $filter = app()->make(RegionFilter::class,['queryParams' => array_filter($request->all())]);

        return Region::filter($filter)->get();

    }

    public function cities(Request $request)
    {
        $filter = app()->make(CityFilter::class,['queryParams' => array_filter($request->all())]);

        return City::filter($filter)->with('metro')->get();

    }

    public function metro(Request $request)
    {
        $filter = app()->make(MetroFilter::class,['queryParams' => array_filter($request->all())]);

        return Metro::filter($filter)->get();

    }
}
