<?php


namespace App\Telegram;


use App\Http\Resources\OfferResource;
use App\Models\Offer;


use DefStudio\Telegraph\Exceptions\TelegraphPollException;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;

trait Actions
{
    public function feedbackRegionExcursion()
    {
        $data = $this->data->get('value');

        $offers = Offer::where('category_id',13)->where('region_id',$data)->get();
        $this->chat
            ->message('Выберете вуз')
            ->keyboard(
                Keyboard::make()->buttons($offers->map(function ($item){
                    return Button::make( $item->name)->action( 'feedbackOffer')->param('value', $item->id);
                }))
            )->send();
//        $this->chat->html("feedbackRegionExcursion-$data")->send();
//        Telegraph::message('Фото Галерея')->photo(asset('/uploads/1142x1020/68792f84f3e23.jpg'))->send();
//        Telegraph::message('Фото Галерея')->mediaGroup([
//            [
//                'type' => 'photo',
//                'media' => asset('/uploads/1142x1020/68792f84f3e23.jpg')
//            ],
//            [
//                'type' => 'photo',
//                'media' => asset('/uploads/1083x722/68790f1060e73.jpg')
//            ],
//        ])->send();
//        Telegraph::photo(asset('/uploads/1142x1020/68792f84f3e23.jpg'))->send();
//        Telegraph::photo(asset('/uploads/1083x722/68790f1060e73.jpg'))->send();
//        if($data == 2)Telegraph::photo(Storage::path('public/foto.jpg'))->send();
//        if($data == 3)Telegraph::video('data/video.mp4')->send();
//        if($data == 4)Telegraph::document('data/file.txt')->send();
    }
    public function feedbackRegionTours()
    {
        $data = $this->data->get('value');

        $offers = Offer::where('category_id',12)->where('region_id',$data)->get();
        $this->chat
            ->message('Выберете вуз')
            ->keyboard(
                Keyboard::make()->buttons($offers->map(function ($item){
                    return Button::make( $item->name)->action( 'feedbackOffer')->param('value', $item->id);
                }))
            )->send();
    }

    public function feedbackOffer(){
        $data = $this->data->get('value');
        $offer = (new OfferResource(Offer::find($data)))->resolve();

        $this->chat->message($offer['name'])->send();
        $this->chat->mediaGroup(collect($offer['gallery'])->map(function ($item){
            return [
                'type' => 'photo',
                'media' => asset($item->src)
            ];
        })->toArray())->send();
            $this->chat->html(json_decode(collect($offer['properties'])->firstWhere('id',1)->pivot->value))->send();

        $this->chat
            ->message('Желаете записаться ?')
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make( 'Да')->webApp( asset($offer['category']->slug."/".$offer['id'])),
                    Button::make( 'Выбрать другой')->webApp( asset('catalog')),
                ]),

            )->send();
//        $this->chat->message('Желаете записаться ?')
//            ->replyKeyboard(ReplyKeyboard::make()->buttons([
//
//                ReplyButton::make('Да')->webApp(asset($offer['category']->slug."/".$offer['id'])),
//                ReplyButton::make('Выбрать другой')->webApp(asset('catalog')),
//            ]))->send();
    }
}
