<?php


namespace App\Telegram;


use App\Models\Offer;
use App\Models\Region;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;

trait Commands
{



    public function start()  // название фунции соответствует команде в телеге /start
    {
        $this->reply("Привет новому пользователю");  // отправка текста
        //$this->chat->html("<i>Курсив</i>")->send();  //отправляем html
    }


    public function com()
    {
        Telegraph::registerBotCommands([
            'excursion' => 'Экскурсии',
            'tours' => 'Туры',
            'contacts' => 'Контакты'
        ])->send();
//         Telegraph::unregisterBotCommands()->send();  // убираем меню
    }
    public function excursion()
    {
        $regions = Region::whereIn('id',Offer::where('category_id',13)->distinct('region_id')->pluck('region_id'))->get();
        $this->chat
            ->message('Выберете регион')
            ->keyboard(
                Keyboard::make()->buttons($regions->map(function ($item){
                    return Button::make( $item->name)->action( 'feedbackRegionExcursion')->param('value', $item->id);
                }))
            )->send();

    }
    public function tours()
    {
        $regions = Region::whereIn('id',Offer::where('category_id',12)->distinct('region_id')->pluck('region_id'))->get();
        $this->chat
            ->message('Выберете регион')
            ->keyboard(
                Keyboard::make()->buttons($regions->map(function ($item){
                    return Button::make( $item->name)->action( 'feedbackRegionTours')->param('value', $item->id);
                }))
            )->send();

    }
    public function contacts()
    {
        $this->reply("Жалоба принята!");
    }
//
//    public function clava(){
//        Telegraph::message('Клавиатура')
//            ->replyKeyboard(ReplyKeyboard::make()->buttons([
//                ReplyButton::make('Текст'),
//                ReplyButton::make('Отправить контакт')->requestContact(),
//                ReplyButton::make('Отправить местоположение')->requestLocation(),
//                ReplyButton::make('Создать опрос')->requestPoll(),
//                ReplyButton::make('Создать тест')->requestQuiz(),
//                ReplyButton::make('Запустить веб-приложение')->webApp('https://www.google.kz/'),
//            ]))->send();
//    }
//
//    public function clavano(){
//        Telegraph::message('command received')
//            ->removeReplyKeyboard()
//            ->send();
//    }

}
