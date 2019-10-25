<?php


namespace Local\Core\Text\Format;


/**
 * Class FormatConsult
 *
 * Форматирует текст для описания категории консультации
 *
 * @package Local\Core\Text\Format
 */
class FormatConsult extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);

        $strText = (new FormatTwoColumn())->format($strText);

        return $strText;
    }
}