<?php


namespace Local\Core\Text\Format;


/**
 * Class FormatNewLine
 *
 * Убирает \r\n
 *
 * @package Local\Core\Text\Format
 */
class FormatNewLine extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);

        return str_replace(["\r\n", "\n"], '', $strText);
    }
}