<?php


namespace Local\Core\Text\Format;


/**
 * Class FormatSnippetTwoColumn
 *
 * Форматирует снипет 2х колонок
 *
 * @package Local\Core\Text\Format
 */
class FormatSnippetTwoColumn extends BaseFormat
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