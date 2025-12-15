<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Filters\ImageFilter;
use App\Http\Requests\ImageCropRequest;
use App\Http\Requests\ImageToFolderRequest;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Resources\ImageResource;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{

    use HelperTrait;
    public function __construct()

    {
        $this->middleware('auth:api', ['only' => ['store','update','destroy']]);

    }
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $filter = app()->make(ImageFilter::class, ['queryParams' => array_filter($request->all())]);
        if ($request->has('limit')) {
            return ImageResource::collection(\App\Models\Image::filter($filter)->get());
        } else {
            return ImageResource::collection(\App\Models\Image::filter($filter)->paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
     * @param string $id
     * @return mixed
     */
    public function update(string $id): mixed
    {
        $image = \App\Models\Image::findOrFail($id);

        $folder_id = $image->folder_id;
        $image->folder_id = $image->was_folder_id;
        $image->was_folder_id = $folder_id;
        $image->save();

        return $image;
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function destroy(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $image = \App\Models\Image::findOrFail($id);

        if (AccessPermission::isDelete($request->user()->role_id)) {
            return response()->json([
                'errors' => [
                    'alert' => [
                        'title' => 'Что то пошло не так',
                        'text' => 'У вас нет прав на удаление',
                        'type' => 'error',
                    ]
                ]
            ], 422);

        }
        File::delete([
            public_path($image->src),
            public_path($image->webp)
        ]);
        return response()->json($image->delete(), 204);
    }


    public function dropzoneStore(Request $request)
    {
        $disc = 'uploads';
        $folder = $request->get('folder');
        if (!Folder::find($folder)) {
            $folder = 1;
        }
        if ($folder == 2) {
            $folder = 1;
        }


        $image = $request->file('file');
        $extension = $image->extension();
        $nameOriginal = $image->getClientOriginalName();
        $path = uniqid();

        $thumbnail = Image::make($image);
        $height = $thumbnail->height();
        $width = $thumbnail->width();

        $this->createDir('uploads/' . $width . 'x' . $height);
        $this->createDir('uploads/original/' . $width . 'x' . $height);
        $this->createDir('uploads/webp/' . $width . 'x' . $height);

        $thumbnail->save(public_path($disc . '/original/' . $width . 'x' . $height . '/' . $path . '.webp'));
        if ($width > 720){

            $thumbnail->resize(720,$height / ($width / 720));

        }
        if ($request->has('size') && $request->get('size') != 'undefined'){
            $size = explode('x',$request->get('size'));
            if ($size[0] != $width || $size[1] != $height){
                return response()->json([
                    'errors' => [
                        'alert' => [
                            'title' => 'Предупреждение!',
                            'text' => 'Несоответсвие сооотношение сторон '. $request->get('size'),
                            'type' => 'error',
                        ]
                    ]
                ], 422);

            }


        }




        $thumbnail->save(public_path($disc . '/' . $width . 'x' . $height . '/' . $path . '.' . $extension));

        $thumbnail->save(public_path($disc . '/webp/' . $width . 'x' . $height . '/' . $path . '.webp'));


        return new ImageResource(\App\Models\Image::create([
            'folder_id' => $folder,
            'name' => $nameOriginal,
            'extension' => $extension,
            'disk' => "$disc/" . $width . "x" . $height . '/',
            'path' => $path,
            'width' => $width,
            'height' => $height,

        ]));


    }

    public function imageToFolder(ImageToFolderRequest $request)
    {

        $image = \App\Models\Image::findOrFail($request->get('id'));

        $image->was_folder_id = $image->folder_id;
        $image->folder_id = $request->get('folder');

        $image->save();

        return $image;
    }

    public function imageDeleteIds(Request $request)
    {
        $images = \App\Models\Image::whereIn('id', $request->get('ids'));

        if ($request->get('folder') == 2) {

            foreach ($images->get() as $image) {
                File::delete([
                    public_path($image->src),
                    public_path($image->webp)
                ]);
            }
            if ($images->preview_id){
                $preview = \App\Models\Image::find($images->preview_id);
                if ($preview){
                    $preview->delete();
                }

            }

            $images->delete();
            return response()->json([
                'errors' => [
                    'alert' => [
                        'title' => 'Уведомление',
                        'text' => 'Все успешно',
                        'type' => 'success',
                    ]
                ]
            ], 422);
        } else {
            $images = $images->get();
        }


        foreach ($images as $image) {
            $image->was_folder_id = $image->folder_id;
            $image->folder_id = 2;
            $image->save();
        }

        return response()->json([
            'errors' => [
                'alert' => [
                    'title' => 'Уведомление',
                    'text' => 'Успешно удалено ' . $images->count() . ' файлов',
                    'type' => 'success',
                ]
            ]
        ], 422);

    }


    public function saveImageData($data){
        $disc = 'uploads';
        $folder = $data['folder'] ?? 1;
        $nameOriginal = $data['name'];
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data['image']));
        $thumbnail = Image::make($image);

        $width = $thumbnail->width();
        $height = $thumbnail->height();
        $extension = 'png';
        $path = uniqid();
        $this->createDir('uploads/' . $width . 'x' . $height);
        $this->createDir('uploads/webp/' . $width . 'x' . $height);

        $thumbnail->save(public_path($disc . '/' . $width . 'x' . $height . '/' . $path . '.' . $extension));

        $thumbnail->save(public_path($disc . '/webp/' . $width . 'x' . $height . '/' . $path . '.webp'));

        return \App\Models\Image::create([
            'folder_id' => $folder ,
            'name' => $nameOriginal,
            'extension' => $extension,
            'disk' => "$disc/" . $width . "x" . $height . '/',
            'path' => $path,
            'width' => $width,
            'height' => $height,

        ]);
    }
    public function imageCrop(ImageCropRequest $request): ImageResource
    {
        $data = $request->validated();
        return new ImageResource($this->saveImageData($data));

    }

    public function videoDownload(StoreVideoRequest $request){
        $data =  $request->validated();

        $video = $request->file('file');

        $nameOriginal = $video->getClientOriginalName();

        $data['name'] = $nameOriginal;
        $image =  $this->saveImageData($data);

        $path = uniqid();
        $extension = $video->extension();

        $imageName = $path . '.' . $extension;

        $video->move(public_path("videos/"), $imageName);
        return \App\Models\Image::create([
            'folder_id' => 3,
            'name' => $nameOriginal,
            'extension' => $extension,
            'disk' => "videos/",
            'path' => $path,
            'preview_id' => $image->id,

        ]);

    }




}
