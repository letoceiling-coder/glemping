<?php

namespace App\Http\Controllers\Api\v1;


use App\Helpers\Bitrix\BitrixFather;
use App\Http\Controllers\Controller;
use App\Models\EmailSend;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

    private array $request;
    private array $errors = [
        'errors' => []
    ];

    const MAIL_TO = 'partnership@povuzam.ru';
    const MAIL_TO_ = 'dsc-23@yandex.ru';




   static public function sendEmail($subject,$template,$form){
         $mail = Mail::send(['html' => $template], ['form' => $form], function ($message) use ($form, $subject) {
            $message->to(self::MAIL_TO, 'Повузам')->subject($subject);
            $message->to(self::MAIL_TO_, 'Повузам')->subject($subject);

        });
       return true;
    }

    public function send(Request $request): \Illuminate\Http\JsonResponse|bool
    {

        $this->request = $request->all();

        $this->validated();
        if (count($this->errors['errors']) > 0){

            return response()->json($this->errors,422);
        }

        $form = EmailSend::create([
            'data' => $this->createForm()
        ]);
        if($request->has('offer_id')){
            if ((new BitrixFather())->get(EmailSend::find($form->id))){
                $form->bitrix_send = true;
                $form->save();
            }

        }

       return $this->sendEmail('Форма с сайта','mail.offer',$form);

    }

    public function createForm(): array
    {
        $form = [];
        foreach ($this->request['data'] as $row){
            foreach ($row['cols'] as $col){


                $form[$col['keys']] = [
                    'value' => $col['data']['value'] ?? '',
                    'label' => $col['data']['label']
                ];
            }
        }
        if (isset($this->request['offer_id'])){
            $form['offer_id'] = [
                'value' => $this->request['offer_id'],
                'label' => 'Предложение'
            ];
        }
        if (isset($this->request['user'])){
            $form['user'] = [
                'value' => $this->request['user'],
                'label' => 'Пользователь'
            ];
        }
        return $form;
    }

    public function validated(){
        $this->statement()->checkFields();
    }

    public function statement(){
        if ($this->request['statement'] && !isset($this->request['statement_check']) || !$this->request['statement_check']){
            $this->errors['errors']['statement_text'] = ['Не отмечены обязательные поля'];
        }
        return $this;
    }

    public function checkFields(){
        foreach ($this->request['data'] as $row){
            foreach ($row['cols'] as $col){

                if (isset($col['required']) && isBoolean($col['required'])){

                    if (!isset($col['data']['value']) || !$col['data']['value'] ){
                        $this->errors['errors'][$col['keys']] = ['Не отмечены обязательные поля'];


                    }
                }
            }
        }
        return $this;
    }
}
