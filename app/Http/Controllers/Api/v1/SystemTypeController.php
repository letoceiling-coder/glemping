<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSystemTypeRequest;
use App\Models\SystemType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SystemTypeController extends Controller
{

    public function __construct()

    {
        $this->middleware('admin.root', ['only' => ['store','update','destroy']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {

        return SystemType::all();
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreSystemTypeRequest $request
     */
    public function store(StoreSystemTypeRequest $request)
    {

        return SystemType::create($request->validated());
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return mixed
     */
    public function show(string $id): mixed
    {

        return SystemType::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     * @param StoreSystemTypeRequest $request
     * @param string $id
     */
    public function update(StoreSystemTypeRequest $request, string $id)
    {
        $type = SystemType::findOrFail($id);
        $type->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $type = SystemType::findOrFail($id);
        $type->delete();
        return response()->json(null,204);
    }
}
