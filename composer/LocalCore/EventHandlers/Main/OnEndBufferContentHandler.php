<?php

namespace Local\Core\EventHandlers\Main;


class OnEndBufferContentHandler
{
    public static function formatCommon(&$content)
    {
        if(preg_match('/^\/bitrix\//', \Bitrix\Main\Application::getInstance()->getContext()->getRequest()->getRequestUri()) !== 1)
        {
            $content = (new \Local\Core\Text\Format\FormatCommon())->format($content);
        }
    }
}