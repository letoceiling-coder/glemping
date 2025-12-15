<?php


namespace App\Helpers\Email;


use Illuminate\Support\Facades\App;

class Notification
{

     static function sendPassword($form): bool|\Illuminate\Mail\SentMessage|null
     {
         if (App::environment('local')) return true;
         $subject = "Доступ к личному кабинету";
         $template = 'mail.send-password';

         return \Illuminate\Support\Facades\Mail::send(['html' => $template], ['form' => $form], function ($message) use ($form, $subject) {
             $message->to($form['email'], 'Глемпинг')->subject($subject);
         });
    }
}
