<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\Menu;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateGuestCountRequest;
use App\Models\NumberGuests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    use HelperTrait;
    public function getMenus(Request $request){


            $menus =  Menu::getMenu();
            return $this->resetKeys($menus->where('role','<=',$request->user()->role->id)->sortBy('sort'));

    }
    public function getMenu(Request $request, string $name){

        $menus =  Menu::getMenu();
        return $menus->firstWhere('slug',$name) ?? $menus->firstWhere('space',$name);

    }

    public function guest(UpdateGuestCountRequest $request){
        Cache::forget('numberGuest');
        NumberGuests::first()->update($request->validated());
        return Cache::remember('numberGuest',60*60*2,function (){
            return NumberGuests::first();

        });

    }
}
