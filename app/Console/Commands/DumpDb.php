<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class DumpDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создание админ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '1000000M');
        $this->info("Start");
        $field = 'db';
        foreach (File::files(database_path('migrations')) as $file){
            $first = '_create_';
            $last = '_table';
            $string = $file->getFilename();
            $start = stripos($string, $first); // first occurrence position
            $length = strripos($string, $last); // last occurrence position
            $newString = substr($string, $start, ($length-$start+strlen($last)));
            $newString = str_replace([$first,$last],'',$newString);
            $className =  Str::studly(Str::singular($newString));
            $response = $this->getModel($className);
            if (!$response){
                continue;
            }

            $response = DB::table($newString)->get();
            File::put(database_path($field.'/'.$className.'.json'),json_encode($response));
            $this->info("end ". $className);
        }


        $this->info("Success");


    }
    public function getModel($model)
    {
        if (file_exists(app_path('/Models/'.$model.'.php'))){
            return App::make('App\Models\\' . $model);
        }
        return false;
    }
}
