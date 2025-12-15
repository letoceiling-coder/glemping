<?php


namespace App\Helpers\Admin;


class Property
{

    static public function getProperty(){
        return collect(self::getSettingsProperty())->map(function ($item,$key){
            return $item['data'];
        });
    }
    static public function getSettingsProperty(): array
    {
        return [
            'company' => [
                'name' => 'Название компании',
                'data' => '',
                'type' => 'string'
            ],
            'logo' => [
                'name' => 'Логотип',
                'data' => '/img/official/logo.svg',
                'type' => 'image'
            ],
            'address' => [
                'name' => 'Адрес',
                'data' => 'Башарово, Кировская область',
                'type' => 'string'
            ],
            'email' => [
                'name' => 'Email основной',
                'data' => 'support@ultra.com',
                'type' => 'email'
            ],

            'phone' => [
                'name' => 'Телефон основной',
                'data' => '+1 (123) 456-7890',
                'type' => 'phone'
            ],

            'mode' => [
                'name' => 'Режим работы',
                'data' => '9:00 - 19:00',
                'type' => 'string'
            ],
            'inn' => [
                'name' => 'ИНН',
                'data' => '',
                'type' => 'number'
            ],
            'kpp' => [
                'name' => 'КПП',
                'data' => '',
                'type' => 'number'
            ],
            'vk' => [
                'name' => 'Соцсети VK',
                'data' => '',
                'type' => 'link'
            ],
            'whatsapp' => [
                'name' => 'Соцсети whatsapp',
                'data' => '+7 905 444 02 02',
                'type' => 'link'
            ],
            'telegram' => [
                'name' => 'Соцсети telegram',
                'data' => 'lesvokrug',
                'type' => 'link'
            ],
            'script' => [
                'name' => 'Дополнительные Скрипты HEAD',
                'data' => "",
                'type' => 'html'
            ],

            'script_body' => [
                'name' => 'Дополнительные Скрипты BODY',
                'data' => "",
                'type' => 'html'
            ],
        ];
    }
}
