<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RootController extends Controller
{
    private string $accessToken;
    /**
     * @var Client
     */
    private Client $client;
    private string $url;
    /**
     * @var mixed
     */
    private $image;
    /**
     * @var mixed
     */
    private $user;

    public function __construct()
    {
        $this->client = new Client();
        $this->accessToken = '';
        $this->url = asset('https://povuzam.ru/api/v1/');
//        $this->url = asset('http://telegraph/api/v1/');
        $this->getLogin();
    }

    public function getLogin()
    {
        $route = 'user/login';
        $this->user = $this->make($this->url . $route, [

            'email' => 'dsc-rootssss@yandex.ru',

            'password' => 123123123,

        ], 'POST');

        $this->accessToken = $this->user?->accessToken ?? '';
    }

    public function get()
    {

        $this->image = $this->downLoadImage();

        if (!$this->user){
            $route = 'user/register';
            $this->user = $this->make($this->url . $route, [
                'name' => 'root',
                'email' => 'dsc-rootssss@yandex.ru',
                'role_id' => 999,
                'password' => 123123123,
                'password_confirmation' => 123123123,
            ], 'POST');

            $this->accessToken = $this->user->accessToken;
        }
        dump($this->updatePages());
//
//        $route = 'images';
//
//        $images = $this->make($this->url . $route, [
//            'limit' => 50000,
//        ]);

//dump($this->getUsers());
//        $this->deleteImage();
        $route = 'users/' . $this->user->user->id;

//        $this->bannerSwipers();
//        $this->UpdateTeachers();
//        $this->UpdatePublishes();
//        $this->UpdateAwards();
//        $this->UpdatePartners();
//        $this->UpdateBlogs();

//
//        $route = 'pages/1';
//        $page = $this->make($this->url . $route, [
//
//        ], 'GET');
//
//
//        foreach ($page->data as $key => $item) {
//            foreach ($item->setting->components as $k => $comp) {
//                dump($comp);
//            }
//        }


//        $route = 'users/80';
//        $res = $this->make($this->url . $route, [
//            '_method' => 'DELETE',
//        ], 'POST');






        $route = 'users/' . $this->user->user->id;
        $res = $this->make($this->url . $route, [
            '_method' => 'DELETE',
        ], 'POST');


        dd('$res');

    }
    public function updatePages()
    {

        $pages = $this->getPages();

        foreach ($pages->data as $item) {
            $route = 'pages/' . $item->id;
            $this->make($this->url . $route, [
                'data' => [],
                '_method' => "PUT",
            ], 'POST');
        }

    }
    public function getPages(){
        $route = 'pages';
       return $pages = $this->make($this->url . $route, [
        ], 'GET');
    }
    public function make($route, $params, $method = 'GET')
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->accessToken,
        ];

        try {
            $response = null;

            if ($method == "GET") {
                $response = $this->client->request($method, $route, [
                    'headers' => $headers,
                    'query' => $params
                ]);

            } elseif ($method == "POST") {
                $response = $this->client->request($method, $route, [
                    'headers' => $headers,
                    'json' => $params
                ]);
            }
            if ($response) {

                return json_decode($response->getBody());
            }

        } catch (GuzzleException $e) {
            dump($e->getMessage(),json_decode($e->getMessage(),true));
        }

    }

    public function downLoadImage()
    {
        $route = 'images/dropzone/store';
        $response = Http::attach('file', file_get_contents(public_path('img/warning.png')), 'warning.png', ['Content-Type' => 'image/png'])->post($this->url . $route);


        return json_decode($response->body());
    }

    public function bannerSwipers()
    {
        $route = 'banner_swipers';
        $banner_swipers = $this->make($this->url . $route, [
        ], 'GET');
        foreach ($banner_swipers->data as $item) {
            $route = 'banner_swipers/' . $item->id;
            $this->make($this->url . $route, [
                'image_d_id' => $this->image->data,
                'image_m_id' => $this->image->data,
                '_method' => "PUT",
            ], 'POST');
        }

    }

    public function getUsers()
    {
        $route = 'users';
        $users = $this->make($this->url . $route, [
        ], 'GET');
        dump($users);
        foreach ($users->data as $item) {
            $route = 'users/' . $item->id;
            $this->make($this->url . $route, [
                'role_id' => 1,
                '_method' => "PUT",
            ], 'POST');
        }


    }

    public function UpdateTeachers()
    {
        $route = 'teachers';
        $teachers = $this->make($this->url . $route, [
        ], 'GET');

        foreach ($teachers->data as $item) {
            $route = 'teachers/' . $item->id;
            $this->make($this->url . $route, [
                'image_id' => $this->image->data,
                '_method' => "PUT",
            ], 'POST');
        }

    }

    public function UpdatePublishes()
    {
        $route = 'publishes';
        $publishes = $this->make($this->url . $route, [
        ], 'GET');

        foreach ($publishes->data as $item) {
            $route = 'publishes/' . $item->id;
            $this->make($this->url . $route, [
                'image_id' => $this->image->data,
                '_method' => "PUT",
            ], 'POST');
        }

    }

    public function UpdateAwards()
    {
        $route = 'awards';
        $publishes = $this->make($this->url . $route, [
        ], 'GET');

        foreach ($publishes->data as $item) {
            $route = 'awards/' . $item->id;
            $this->make($this->url . $route, [
                'image_id' => $this->image->data,
                '_method' => "PUT",
            ], 'POST');
        }

    }

    public function UpdatePartners()
    {
        $route = 'partners';
        $publishes = $this->make($this->url . $route, [
        ], 'GET');

        foreach ($publishes->data as $item) {
            $route = 'partners/' . $item->id;
            $this->make($this->url . $route, [
                'image_id' => $this->image->data,
                '_method' => "PUT",
            ], 'POST');
        }

    }

    public function UpdateBlogs()
    {
        $route = 'blogs';
        $publishes = $this->make($this->url . $route, [
        ], 'GET');

        foreach ($publishes->data as $item) {

            try {
                $this->make($this->url . $route, [
                    'images' => [$this->image->data],
                    '_method' => "PUT",
                ], 'POST');
            }
            catch (\Exception $e){

            }

        }

    }

    public function deleteImage()
    {
        $route = 'images';

        $images = $this->make($this->url . $route, [
            'limit' => 50000,
        ]);
        $route = 'images/delete/ids';
        $images = $this->make($this->url . $route, [
            'ids' => collect($images->data)->pluck('id'),
            '_method' => 'DELETE',
            'folder' => 2
        ], 'POST');
//        dd($images);
    }
}
