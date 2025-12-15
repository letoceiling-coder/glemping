<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Admin\Menu;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateGuestCountRequest;
use App\Models\NumberGuests;
use DiDom\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index(){
        $cards = Http::get("https://yandex.ru/maps/org/191983457893/reviews");
        $document = new Document($cards->body());
        $posts = $document->find('.business-reviews-card-view__review');
        $reviews = [];
        foreach($posts as $key => $post) {

//            echo $post;
            $reviews[$key] = [];
            $review =  $post->first('.business-review-view__header [itemprop=reviewRating]');
            $reviews[$key]['date'] = $post->first('.business-review-view__header .business-review-view__date span')->text();
            $reviews[$key]['datePublished'] = $post->first('.business-review-view__header .business-review-view__date [itemprop=datePublished]')->attr('content');
            $reviews[$key]['image'] = $post->first('.business-review-view__author-container .business-review-view__author-name [itemprop=image]')?->attr('content');
            $reviews[$key]['bestRating'] = $review->first('[itemprop=bestRating]')->attr('content');
            $reviews[$key]['worstRating'] = $review->first('[itemprop=worstRating]')->attr('content');
            $reviews[$key]['ratingValue'] = $review->first('[itemprop=ratingValue]')->attr('content');
            $reviews[$key]['review'] = $post->first('.spoiler-view__text-container')->text();
            $images = $post->find('.business-review-view__carousel .business-review-media__item img');

            $reviews[$key]['images'] = [];
            if ($images){
                foreach($images as $k => $image) {
                    $reviews[$key]['images'][$k] = $image->first('.business-review-media__item-img')->attr('src');
                }
            }

        }

        dd($reviews);
       echo $document;
    }
}
