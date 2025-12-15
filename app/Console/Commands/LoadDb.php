<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoadDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:loadDb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Загрузка ДБ';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        ini_set('memory_limit', '1000000M');
        $path = "db";
        $this->info("Start");

        foreach (File::files(database_path('migrations')) as $file){
            $first = '_create_';
            $last = '_table';
            $string = $file->getFilename();
            $start = stripos($string, $first); // first occurrence position
            $length = strripos($string, $last); // last occurrence position
            $newString = substr($string, $start, ($length-$start+strlen($last)));
            $newString = str_replace([$first,$last],'',$newString);
            $className =  Str::studly(Str::singular($newString));
            if (file_exists(database_path($path . "/$className.json"))) {
                $this->info("Start " . $className);
                $model = App::make('App\Models\\' . $className);

                $data = json_decode(File::get(database_path($path . "/$className.json")), true);

                foreach ($data as $item) {
                    $model->create($item);
                }
                $this->info("Success " . $className);


            }

            $this->info("end ". $className);
        }


        $this->info("Success");

    }
}
