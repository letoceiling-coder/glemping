<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\Property;
use App\Helpers\Settings\SettingPage;
use App\Helpers\Settings\SettingSite;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return SettingPage::getSettings();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        foreach ($request->all() as $key => $value){
            Setting::updateOrCreate(['key_' => $key],[
                'key_' => $key,
                'value_' => $value,
            ]);
        }
        return $this->index();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
