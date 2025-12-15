<?php


namespace App\Helpers\Image;



use App\Http\Controllers\Api\v1\HelperTrait;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageSize
{
    use HelperTrait;
    public array $folders ;

    public string $path = 'G:\OSPanel\domains\root\glempingServer\public\\';
    public string $pathFolders = '/img/uploads';
    public function __construct()
    {

//       foreach (File::directories(public_path($this->pathFolders)) as $folder){
//           $path = str_replace('\\','/',str_replace($this->path,'',$folder));
//           $explode = explode('/',$path);
//           $folderName = end($explode);
//           if ($folderName != 'webp'){
//               $files = File::files(public_path($this->pathFolders."/".$folderName));
//               foreach ($files as $file){
//                 $fileName = public_path($this->pathFolders."/".$folderName."/".$file->getFilename());
//                   $this->folders[$folderName][] = $fileName;
//                    $this->size($fileName,$folderName,$file->getFilename());
//               }
//
//
//           }
//
//       }
        $path = public_path('/img/map.png');
        $thumbnail = Image::make($path);
        $height = $thumbnail->height();
        $width = $thumbnail->width();

        if ($width > 720){

            $thumbnail->resize(720,$height / ($width / 720));

        }


        $thumbnail->save(public_path("/img/map.webp"));
        dd($thumbnail);
    }

    public function size($path,$folderName,$name){


        $thumbnail = Image::make($path);
        $height = $thumbnail->height();
        $width = $thumbnail->width();

        if ($width > 720){

            $thumbnail->resize(720,$height / ($width / 720));

        }
        $this->createDir("/uploads/$folderName");
        $this->createDir("/uploads/webp/$folderName");
        $thumbnail->save(public_path("/uploads/$folderName/$name"));
        $thumbnail->save(public_path("/uploads/webp/$folderName/".explode('.',$name)[0].".webp"));
dump($folderName,$name);

    }
}
