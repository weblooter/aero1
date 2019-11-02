<?php


namespace Local\Core\Text\Format;


/**
 * Class FormatTrim
 *
 * Обрезает пустое начало и конец строки
 *
 * @package Local\Core\Text\Format
 */
class FormatTrim extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);

        return trim(str_replace('&nbsp;', ' ', $strText));
    }
}