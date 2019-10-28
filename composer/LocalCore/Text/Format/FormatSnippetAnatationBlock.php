<?php


namespace Local\Core\Text\Format;

/**
 * Class FormatSnippetAnatationBlock
 *
 * Форматирует снипет блока анатации
 *
 * @package Local\Core\Text\Format
 */
class FormatSnippetAnatationBlock extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);
        $strText = (new FormatNewLine())->format($strText);

        if (preg_match_all('/(\{\{ANATATIONBLOCK\}\}(.*?)\{\{\/ANATATIONBLOCK\}\})/', $strText, $arAnatationBlockMatches) > 0) {
            $arAnatationBlockMatches[0] = array_unique($arAnatationBlockMatches[0]);

            $arReplaceFrom = $arAnatationBlockMatches[0];
            $arReplaceTo = [];


            foreach ($arAnatationBlockMatches[0] as $arAnatationBlockMatch) {
                preg_match('/{{TITLE}}([^{]+){{\/TITLE}}/', $arAnatationBlockMatch, $arTitleMatch);
                preg_match('/{{COLUMN1}}([^{]+){{\/COLUMN1}}/', $arAnatationBlockMatch, $arColumn1);
                preg_match('/{{COLUMN2}}([^{]+){{\/COLUMN2}}/', $arAnatationBlockMatch, $arColumn2);

                $arTmp = [
                    $arTitleMatch[1],
                    $arColumn1[1],
                    $arColumn2[1],
                ];

                list($strTitle, $strColumn1, $strColumn2) = $arTmp;

                $arReplaceTo[] = <<<DOCHERE
<div class="row row-f">
    <div class="col-xs-12 col-md-6">
        <div class="title-preview">$strTitle</div>
        $strColumn1
    </div>
    <div class="col-xs-12 col-md-6">
        $strColumn2
    </div>
</div>
DOCHERE;
            }

            $strText = str_replace($arReplaceFrom, $arReplaceTo, $strText);
        }

        return $strText;
    }
}