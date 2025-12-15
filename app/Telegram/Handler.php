<?php


namespace App\Telegram;


use DefStudio\Telegraph\Handlers\WebhookHandler;


class Handler extends WebhookHandler
{
    use Commands;
    use Text;
    use Actions;


    protected function handleUnknownCommand($text): void
    {
        $this->chat->html("Я не понял команды: $text")->send();
    }





}
