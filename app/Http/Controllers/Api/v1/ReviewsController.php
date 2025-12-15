<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\AccessPermission;
use App\Http\Controllers\Controller;
use App\Http\Filters\OfferFilter;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Offer;
use App\Models\Option;
use App\Models\Property;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReviewsController extends Controller
{


    use HelperTrait;

    public function fields(): array
    {
        return [
            modelForm('id', 'ID'),

            modelFormHide('images', 'фото', 'images'),
         ];

    }

    public function __construct()

    {
        $this->middleware('auth:api', ['only' => ['store', 'update', 'destroy']]);

    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     * @throws BindingResolutionException
     */
    public function index(Request $request): AnonymousResourceCollection
    {

        if ($request->has('paginate') && $request->get('paginate') != 0) {

            return ReviewResource::collection(Review::paginate($request->get('paginate'), ['*'], 'page', $request->get('page') ?? 1));

        } else {

            return ReviewResource::collection(Review::get());
        }

    }

    /**
     * Store a newly created resource in storage.
     * @param StoreReviewRequest $request
     * @return ReviewResource|array
     */

    public function store(StoreReviewRequest $request): ReviewResource|array
    {
        $review = Review::create($request->validated());
        if ($request->has('images')) {
            $review->images()->sync(collect($request->get('images'))->pluck('id')->toArray());
        }

        return new ReviewResource($review);


    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return ReviewResource
     */
    public function show(string $id): ReviewResource
    {
        return new ReviewResource(Review::find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateReviewRequest $request
     * @param string $id
     */
    public function update(UpdateReviewRequest $request, string $id): ReviewResource
    {
       $review = Review::find($id);
        $review->update($request->validated());
        if ($request->has('images')) {
            $review->images()->sync(collect($request->get('images'))->pluck('id')->toArray());
        }

        return new ReviewResource($review);

    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $review = Review::findOrFail($id);

        if ($review->system || AccessPermission::isDelete($request->user()->role_id)) {
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

        return response()->json($review->delete(), 204);
    }
}
