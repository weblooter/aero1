<?php


namespace Local\Core\Text\Format;


/**
 * Class FormatSnippetInfoBlock
 *
 * Форматирует снипет информационного блока
 *
 * @package Local\Core\Text\Format
 */
class FormatSnippetInfoBlock extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);
        $strText = (new FormatNewLine())->format($strText);

        if (preg_match_all('/(\{\{INFOBLOCK\}\}(.*?)\{\{\/INFOBLOCK\}\})/', $strText, $arInfoBlockMatches) > 0) {
            $arInfoBlockMatches[0] = array_unique($arInfoBlockMatches[0]);
            $arInfoBlockMatches[2] = array_unique($arInfoBlockMatches[2]);

            $arReplaceFrom = $arInfoBlockMatches[0];
            $arReplaceTo = [];


            foreach ($arInfoBlockMatches[2] as $strInfoBlockMatch) {

                $strInfoBlockMatch = (new FormatTrim(new FormatStripTags()))->format($strInfoBlockMatch);

                $arReplaceTo[] = <<<DOCHERE
<h4 class="info">$strInfoBlockMatch</h4>
DOCHERE;
            }

            $strText = str_replace($arReplaceFrom, $arReplaceTo, $strText);
        }

        return $strText;
    }
}