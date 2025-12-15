<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Page;
use App\Models\SeoPage;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class SeoController extends Controller
{

    public function seo($seo = []){

        $title = array_shift($seo) ;
        $description = array_shift($seo);

        seo()->title($title);
        seo()->description($description ?? $title);
        seo()->og([
            'title' => seo()->meta()->title() ?? '',
            'description' => seo()->meta()->description() ?? '',
            'image' => asset('/img/header/logo.svg'),
            'type' => 'website',
            'site_name' => 'Глемпинг',
            'url' => url()->current(),
            'updated_time' => Carbon::parse(seo()->meta()->model()->updated_at)->format('c'),
        ]);
    }
    public function __invoke(Request $request)
    {
        $this->seoPages($request->path());

        return view('layouts.app');
    }


    public function seoPages($path){

        $pages = Cache::remember('Pages',60*60*24,function (){
            return Page::all();
        });
        $page = $pages->firstWhere('slug',$path == "/" ? "$path" : "/$path");
        $seoPage = SeoPage::firstWhere('slug',$path == "/" ? "$path" : "/$path");

        if ($seoPage){
            $this->seo([$page->title,$page->description]);
        }elseif ($page){
            $this->seo([$page->title,$page->description]);
        }else{
            $this->seo(['Повузам.рф','Глемпинг']);
        }


    }

}
