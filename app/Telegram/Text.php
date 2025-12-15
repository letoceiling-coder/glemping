<?php


namespace App\Telegram;


trait Text
{
    protected function handleChatMessage($text): void
    {
        $this->chat->html($text)->send();
    }

}
