<?php

namespace Local\Core\EventHandlers\Main;


class OnEndBufferContentHandler
{
    public static function formatCommon(&$content)
    {
        if($_SERVER['PHP_SELF'] == '/index.php')
        {
            $content = (new \Local\Core\Text\Format\FormatCommon())->format($content);
        }
    }
}