<?php

namespace App\Helpers\Bitrix;

use App\Models\EmailSend;
use App\Models\Offer;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BitrixFather
{
    const PATH = 'https://povuzam.bitrix24.ru/rest/29/rzf3c6vgshatsosb/';
    public Client $client;


    public function __construct()
    {
        $this->client = new Client();
    }

    public function createProduct(Offer $offer)
    {


        $data = [
            'fields' => [
                'XML_ID' => $offer->id,
                'NAME' => $offer->name,
                'CURRENCY_ID' => 'RUB',
                'PRICE' => $offer->price,
                'MEASURE' => 9,
                'SORT' => 100,

            ]
        ];

        $response = $this->getRequest('crm.product.add', $data);

        if ($response['status'] == 200) {
            $offer->bitrix_id = $response['getBody']->result;
            $offer->save();
            $this->updateProduct($offer);
        }
        return $response;
    }

    public function updateProduct(Offer $offer)
    {
        if(!$offer->bitrix_id){
            $offer->bitrix_id = $this->productSearch($offer);
            $offer->save();
        }

        $data = [
            'ID' => $offer->bitrix_id,
            'fields' => [
                'DETAIL_PICTURE' => [
                    'fileData' => $this->addImage(json_decode($offer->properties->firstWhere('id',5)->pivot->value))
                ]

            ]
        ];

        return $response = $this->getRequest('crm.product.update', $data, 'POST');
    }
    public function productSearch(Offer $offer)
    {
        $data = [
            'order' => ['NAME' => 'ASC'],
            'filter' => [
                'CATALOG_ID' => 15,
                'XML_ID' => $offer->id
            ],
            'select' => ['*']
        ];
        $response = $this->getRequest('crm.product.list', $data);
        if ($response['status'] == 200 && count($response['getBody']->result) > 0) {
            return $response['getBody']->result[0]->ID;
        }
        return $response;
    }

    public function addImage($images)
    {
        $arr = [];
        foreach ($images as $image) {

            $filePath = public_path($image->src); // Путь к файлу

            $fileData = file_get_contents($filePath); // Читаем файл

            $base64 = base64_encode($fileData); // Кодируем в base64
            return $arr = [
                $image->name,
                $base64
            ];

        }
        return $arr;
    }



    public function get(EmailSend $order)
    {


        $orderData = $order->data;
        $offer = null;
        if ($orderData['offer_id']['value']) {
            $offer = Offer::find($orderData['offer_id']['value']);
        }

//
//        $url = self::PATH . 'crm.deal.list'.".json";
//        try {
//            $res = $this->client->get($url, ['query' => []]);
//
//        } catch (GuzzleException $e) {
//
//            $res = $e;
//
//        }


        $categories = [
            11 => 0,
            12 => 7,
            13 => 0,
            14 => 9,//Консультации
            15 => 13,//Отзывы


        ];
        $data = [
            'FIELDS' => [
                'TITLE' => 'Новая сделка #' . $order->id,
                'TYPE_ID' => 'SALE',
                'CATEGORY_ID' => $categories[$offer->category_id] ?? 0,
                'STAGE_ID' => 'NEW',
                'IS_RECURRING' => 'N',
                'IS_RETURN_CUSTOMER' => 'N',
                'IS_REPEATED_APPROACH' => 'N',
                'ASSIGNED_BY_ID' => '19',

                'CURRENCY_ID' => 'RUB',

                'IS_MANUAL_OPPORTUNITY' => 'Y',
                'TAX_VALUE' => 0.00,
                'COMPANY_ID' => 0,
                'CONTACT_ID' => $this->setUserAdd($order),
                'DATE_MODIFY' => (new DateTime())->format(DateTime::ATOM),
                'DATE_CREATE' => (new DateTime())->format(DateTime::ATOM),
                'MOVED_TIME' => (new DateTime())->format(DateTime::ATOM),
                'LAST_ACTIVITY_TIME' => (new DateTime())->format(DateTime::ATOM),
                'BEGINDATE' => (new DateTime())->format(DateTime::ATOM),
                'CLOSEDATE' => (new DateTime('+10 days'))->format(DateTime::ATOM),
                'OPENED' => 'Y',
                'CLOSED' => 'N',
                'COMMENTS' => '',
                'SOURCE_ID' => null,
                'SOURCE_DESCRIPTION' => null,
                'ADDITIONAL_INFO' => null,
                'UTM_SOURCE' => null,
                'UTM_MEDIUM' => null,
                'ORIGIN_ID' => $order->id,
                'IS_NEW' => "N",
                'UF_CRM_1743521422' => 0,
                'UF_CRM_1742376984105' => isset($orderData['date']['value']) ? \Carbon\Carbon::parse($orderData['date']['value'][0])->format('d.m.Y') : null,//начало тура
                'UF_CRM_1742377102922' => isset($orderData['date']['value']) ? \Carbon\Carbon::parse($orderData['date']['value'][1])->format('d.m.Y') : null,//конец тура
                'UF_CRM_1742806452843' => $orderData['piople']['value'] ?? 1,//количество челевек
                'UF_CRM_1744801358204' => $orderData['piople']['value'] ?? 1,//Количество участников экскурсии
                'UF_CRM_1745418333' => $orderData['phone']['value'],//tel
                'UF_CRM_1745418450' => $orderData['special']['value'] ?? null,//Направление ( специальность )
//                'UF_CRM_1745418551' => $order->data['age'] ?? null,//age
//                'UF_CRM_1745418617' => $order->data['maintainer'] ?? null,//Сопровождающий
                'UF_CRM_1745418675' => $orderData['coment']['value'] ?? null,//comment

            ],
            'PARAMS' => [
                'REGISTER_SONET_EVENT' => 'N',
            ],
        ];
        if (isset($orderData['piople']['value'])){
           $data['OPPORTUNITY'] =  $offer->price * $orderData['piople']['value'];
        }
         $response =  $this->getRequest('crm.deal.add', $data);
        if($response['status'] == 200){
            $order->bitrix_id = $response['getBody']->result;
            $order->save();
            $this->createDealAddProduct($order,$offer);
        }
        return $response;

    }

    public function createDealAddProduct($order,$offer){
        $data = [
            'id' => $order->bitrix_id,
            'rows' => [
                [
                    'PRODUCT_ID' => $offer->bitrix_id,
                    'PRICE' => $offer->price,
                    'QUANTITY' => $order->data['piople']['value'] ?? 1,
//                    'DISCOUNT_TYPE_ID' => 2,
//                    'DISCOUNT_SUM' => 0,
//                    'TAX_RATE' => 13,
                    'MEASURE_CODE' => 9,
                    'MEASURE_NAME' => "шт",
                    'SORT' => 10,
                ]
            ]
        ];
        $response = $this->getRequest('crm.deal.productrows.set', $data);

    }

    public function toArray($res): array
    {
        return [
            'status' => $res->getStatusCode(),
            'getBody' => json_decode($res->getBody()),
        ];
    }

    public function getRequest($method, $params = [], $http = 'GET'): \Illuminate\Http\JsonResponse|array
    {
        $url = self::PATH . $method . ".json";

        if ($http == 'GET') {
            try {
                $res = $this->client->get($url, ['query' => $params]);
                return $this->toArray($res);
            } catch (GuzzleException $e) {
                return false;
                return $this->generateErrors('Ошибка запроса', $e->getMessage())->original;
            }
        }
        if ($http == 'POST') {

            try {
                $res = $this->client->post($url, ['json' => $params]);
                return $this->toArray($res);
            } catch (GuzzleException $e) {
                return false;
                return $this->generateErrors('Ошибка запроса', $e->getMessage())->original;

            }
        }


    }


    public function setUserAdd($order)
    {
        $orderData = $order->data;
        $checkUser = $this->checkUser($orderData['email']['value']);

        if (!$user = User::firstWhere('email',$orderData['email']['value'])){
            $user = User::create([
                'email' => $orderData['email']['value'],
                'name' => $orderData['firstname']['value'] ?? '' . " " . $orderData['lastname']['value'] ?? '',
                'phone' => $orderData['phone']['value'] ?? '' ,
                'password' => Hash::make(Str::random(8)) ,
            ]);
        }

        if(!$checkUser){
            $fields = [
                'fields' => [
                    'ORIGIN_ID' => $user->id,
                    'NAME' => $user->name,
                    'LAST_NAME' => $user->name,
                    'BIRTHDATE' => $user->created_at->format(DateTime::ATOM),
                    'PHONE' => [
                        [
                            'VALUE' => $user->phone,
                            'VALUE_TYPE' => 'WORK',
                        ],

                    ],
                    'EMAIL' => [
                        [
                            'VALUE' => $user->email,
                            'VALUE_TYPE' => 'MAILING',
                        ],

                    ],
                ]


            ];
            $response = $this->getRequest('crm.contact.add',$fields);
            return $response['getBody']->result;
        }else{
            return $checkUser->ID;
        }

    }

    public function checkUser($email){
        $user = $this->getUsers(['filter' =>['EMAIL' => $email]]);

        if($user['getBody']->total > 0){
            return $user['getBody']->result[0];
        }
        return false;

    }

    public function getUsers($param = [])
    {

        return $this->getRequest('crm.contact.list',$param);

    }

    public function getDealList($id = null)
    {
        $data = [
            'SELECT' => [
                '*',

            ],
            'FILTER' => [
                '=%TITLE' => "%$id",
            ],
            'ORDER' => [
                'TITLE' => 'ASC',
                'OPPORTUNITY' => 'ASC',
            ],
        ];
        $response =  $this->getRequest('crm.deal.list', $data);
        if($id){
            if($response['status'] == 200 &&  count($response['getBody']->result) > 0){
                return $response['getBody']->result[0]->ID;
            }

        }
        return $response;
    }

    public function getDealId($id){
        $data = [
            'ID' => $id
        ];
        $response =  $this->getRequest('crm.deal.get', $data);

        return $response;
    }

}
