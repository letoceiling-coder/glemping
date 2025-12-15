<?php


namespace App\Helpers\Admin;


use App\Http\Controllers\Api\v1\HelperTrait;

use Illuminate\Support\Str;

class Menu
{

    use HelperTrait;
    public array $resources = [
        'Stock' => 'Акции',
        'Review' => 'Отзывы',
        'Option' => 'Опции',
        'Service' => 'Услуги',
        'IncludeService' => 'Сервис',
        'Property' => 'Свойства',
        'Offer' => 'Предложения',
        'SpecialOffer' => 'Спец-Предложения',
        'User' => 'Пользователи',
        'UserRole' => 'Роли пользователя',

//        'Currency' => 'Валюты',
//        'Size' => 'Размеры',
//        'Color' => 'Цвета',
//        'Gender' => 'Гендер',
    ];

   static public function getMenu(): \Illuminate\Support\Collection
   {
        return collect([
            [

                'sort' => 10,
                'role' => 900,
                'slug' => 'dashboard',
                'name' => 'Админ панель',
                'icon' => 'fas fa-solid fa-screwdriver-wrench',
                'items' => [

                ],

            ],
            [

                'sort' => 20,
                'role' => 999,
                'slug' => 'components',
                'name' => 'Компоненты',
                'icon' => 'fas  fa-brands fa-mendeley',
                'items' => [

                ],

            ],
            [

                'sort' => 30,
                'role' => 500,
                'slug' => 'media',
                'name' => 'Медиа менеджер',
                'icon' => 'fa-solid fa-image',
                'items' => [

                ],

            ],


            [

                'sort' => 40,
                'role' => 900,
                'slug' => '',
                'space' => 'pages',
                'name' => 'Страницы',
                'icon' => 'fa-solid fa-sitemap',
                'items' => (new Menu)->getPages(),

            ],
            [

                'sort' => 50,
                'role' => 900,
                'slug' => 'menus',
                'name' => 'Меню header',
                'icon' => 'fas fa-bars neg-transition-scale',
                'items' => [],

            ],
            [

                'sort' => 50,
                'role' => 900,
                'slug' => 'menus-footer',
                'name' => 'Меню footer',
                'icon' => 'fas fa-bars neg-transition-scale',
                'items' => [],

            ],
            [

                'sort' => 50,
                'role' => 900,
                'slug' => 'categories',
                'name' => 'Категории',
                'icon' => 'fa-solid fa-list',
                'items' => [],

            ],
            [

                'sort' => 100,
                'role' => 500,
                'slug' => '',
                'space' => 'resource',
                'name' => 'Ресурсы',
                'icon' => 'fa-solid fa-database',
                'items' => (new Menu)->getResources(),

            ],

            [

                'sort' => 55,
                'role' => 900,
                'slug' => 'forms',
                'name' => 'Формы',
                'icon' => 'fa-regular fa-share-from-square',
                'items' => [

                ],

            ],
        ]);


   }
   public function getPages(){

       $pages = [
           [
               "name" => 'Создать',
               "slug" => 'pages',

           ],

       ] ;

       foreach (Page::getPages() as $page){
           $pages[] = [
               "name" => $page['name'],
               "slug" => 'pages/'.$page['id'],

           ];
       }
       return $pages;
   }
   public function getResources(){
       $resources = [];
       foreach ($this->resources as $model => $item){
           $resources[] = [
               "name" => $item,
               "slug" => 'resource/'.$this->getTable($model),

           ];
       }

       return $resources;
   }
}
