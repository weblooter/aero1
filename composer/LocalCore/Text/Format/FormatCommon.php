<?php


namespace Local\Core\Text\Format;


/**
 * Class FormatCommon
 *
 * Форматирует текст заменяя общие снипеты
 *
 * @package Local\Core\Text\Format
 */
class FormatCommon extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);

        $strText = (new FormatTwoColumn())->format($strText);

        return $strText;
    }
}