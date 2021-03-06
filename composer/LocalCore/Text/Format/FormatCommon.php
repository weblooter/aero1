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

        $obFormat = new FormatNewLine();
        $obFormat = new FormatSnippetVideoBlock($obFormat);
        $obFormat = new FormatSnippetTwoColumn($obFormat);
        $obFormat = new FormatSnippetPhotoGallery($obFormat);
        $obFormat = new FormatSnippetAnatationBlock($obFormat);
        $obFormat = new FormatSnippetAnatationBlockConsult($obFormat);
        $obFormat = new FormatSnippetBlockQuote($obFormat);
        $obFormat = new FormatSnippetInfoBlock($obFormat);
        $obFormat = new FormatSnippetServiceVideo($obFormat);

        $strText = $obFormat->format($strText);

        return $strText;
    }
}