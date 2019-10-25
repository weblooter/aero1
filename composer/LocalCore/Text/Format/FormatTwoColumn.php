<?php


namespace Local\Core\Text\Format;


/**
 * Class FormatTwoColumn
 *
 * Форматирует текст в 2 колонки. Используется в консультации
 *
 * @package Local\Core\Text\Format
 */
class FormatTwoColumn extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);

        $strText = str_replace(
            [
                '{{COLUMN_DOUBLE}}',
                '{{/COLUMN_DOUBLE}}',
                '{{COLUMN}}',
                '{{/COLUMN}}',
            ],
            [
                '<div class="col2">',
                '</div>',
                '<div class="column">',
                '</div>',
            ],
            $strText
        );

        return $strText;
    }
}