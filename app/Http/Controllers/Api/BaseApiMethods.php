<?php


namespace App\Http\Controllers\Api;



use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;

class BaseApiMethods
{




    public function getImageUsed($arr){
        return collect($arr)->where('type','image')->pluck('data.id');
    }

    public function getVersion(){
        return request()->get('params')['version'] ?? null;
    }

    public function getLang(){
        return request()->get('params')['lang'] ?? null;
    }
    public function resetKeys($arr){
        return array_values($arr);
    }
    public function getModel($model)
    {
        return App::make('App\Models\\' . $model);
    }
    public function getFields($model)
    {
        return Schema::getColumnListing($model->getTable());
    }
    public function getTable($model)
    {
        return $this->getModel($model)->getTable();
    }

}
