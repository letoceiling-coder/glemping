<?php


namespace App\Http\Controllers\Api\v1;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait HelperTrait
{
    public function resetKeys($arr): array
    {
        if (gettype($arr) == 'array') {
            return array_values($arr);
        } elseif ((gettype($arr) == 'object')) {
            return array_values($arr->toArray());
        }
        return $arr;

    }

    static public function createDir($path)
    {
        if (!is_dir(public_path($path))) {
            File::makeDirectory(public_path($path), $mode = 0777, true, true);
        }
    }

    static public function getModel($model)
    {
        return App::make('App\Models\\' . $model);
    }

    static public function getFields($model): array
    {
        return Schema::getColumnListing($model);
    }

    static public function getForeign($model): array
    {
        return Schema::getForeignKeys($model);
    }
    static function getModelName($table)
    {
        return Str::studly(Str::singular($table));
    }
    public function getTable($model)
    {
        return $this->getModel($model)->getTable();
    }





}
