<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFolderRequest;
use App\Http\Requests\UpdateFolderRequest;
use App\Http\Resources\FolderResource;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return FolderResource::collection(Folder::with('images')->orderBy('sort')->get());
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreFolderRequest $request
     */
    public function store(StoreFolderRequest $request): FolderResource
    {
        return new FolderResource(Folder::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        return new FolderResource(Folder::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateFolderRequest $request
     * @param string $id
     */
    public function update(UpdateFolderRequest $request, string $id)
    {
        $folder = Folder::findOrFail($id);

        $folder->update($request->validated());
        return new FolderResource($folder);
    }

    /**
     * Remove the specified resource from storage.
     * @throws ValidationException
     */
    public function destroy(Request $request,string $id)
    {
        $folder = Folder::findOrFail($id);

        if ($folder->system || AccessPermission::isDelete($request->user()->role_id)){
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

        return response()->json($folder->delete(), 204);
    }

    public function slug(string $slug): FolderResource
    {
        return new FolderResource(Folder::firstWhere('slug',$slug));
    }
    public function deleteFolders(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        Folder::whereIn('id',$request->get('ids') ?? [])->delete();
        return $this->index();
    }
}
