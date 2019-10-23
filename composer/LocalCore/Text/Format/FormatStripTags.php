<?php


namespace Local\Core\Text\Format;

/**
 * Class FormatStripTags
 *
 * Обрезает html теги
 *
 * @package Local\Core\Text\Format
 */
class FormatStripTags extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);

        return strip_tags($strText);
    }
}