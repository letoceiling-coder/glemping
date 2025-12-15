<?php


namespace App\Helpers\Settings;


use App\Models\Setting;




class SettingPage
{


    public function __construct()
    {

    }

    public function getInfo()
    {

    }

    static public function getTopPanel($country = 'RU'): string
    {
        return "";
    }



    static public function getSettings()
    {


        $property = [

            'logo' => [
                'label' => 'Лого',
                'text' => '/img/official/logo.svg',
                'type' => 'image'
            ],
            'address' => [
                'label' => 'Адрес',
                'text' => 'Башарово, Кировская область',
                'type' => 'string'
            ],
            'email' => [
                'label' => 'Email основной',
                'text' => 'support@ultra.com',
                'type' => 'string'
            ],

            'phone' => [
                'label' => 'Телефон основной',
                'text' => '+1 (123) 456-7890',
                'type' => 'string'
            ],

            'mode' => [
                'label' => 'Режим работы',
                'text' => '9:00 - 19:00',
                'type' => 'string'
            ],
            'inn' => [
                'label' => 'ИНН',
                'text' => '',
                'type' => 'number'
            ],
            'kpp' => [
                'label' => 'КПП',
                'text' => '',
                'type' => 'number'
            ],
            'vk' => [
                'label' => 'Соцсети VK',
                'text' => '',
                'type' => 'string'
            ],
            'whatsapp' => [
                'label' => 'Соцсети whatsapp',
                'text' => '+7 905 444 02 02',
                'type' => 'string'
            ],
            'telegram' => [
                'label' => 'Соцсети telegram',
                'text' => 'lesvokrug',
                'type' => 'string'
            ],

            'script' => [
                'label' => 'Дополнительные Скрипты HEAD',
                'html' => "",
                'type' => 'html'
            ],

            'script_body' => [
                'label' => 'Дополнительные Скрипты BODY',
                'html' => "",
                'type' => 'html'
            ],
        ];
        $settings = Setting::whereIn('key_', collect($property)->keys())->get();
        $arr = [];
        foreach ($property as $key => $value) {

            if ($settings->firstWhere('key_', $key)) {

                $property[$key] = $settings->firstWhere('key_', $key)->value_;
                $arr[$key] = $settings->firstWhere('key_', $key)->value_;

            }else{
                $arr[$key] = $value;
            }
        }


        return $property;

    }
}
