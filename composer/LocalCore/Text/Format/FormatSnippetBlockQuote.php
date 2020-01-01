<?php


namespace Local\Core\Text\Format;

/**
 * Class FormatSnippetBlockQuote
 *
 * Форматирует снипет цитаты
 *
 * @package Local\Core\Text\Format
 */
class FormatSnippetBlockQuote extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);
        $strText = (new FormatNewLine())->format($strText);

        if (preg_match_all('/(\{\{BLOCKQUOTE\}\}(.*?)\{\{\/BLOCKQUOTE\}\})/', $strText, $arBlockQuoteMatches) > 0) {
            $arBlockQuoteMatches[0] = array_unique($arBlockQuoteMatches[0]);

            $arReplaceFrom = $arBlockQuoteMatches[0];
            $arReplaceTo = [];


            foreach ($arBlockQuoteMatches[0] as $arBlockQuoteMatch) {
                preg_match('/{{TEXT}}([^{]+){{\/TEXT}}/', $arBlockQuoteMatch, $arTextMatch);
                preg_match('/{{USER_IMG}}([^{]+){{\/USER_IMG}}/', $arBlockQuoteMatch, $arUserImgMatch);
                preg_match('/{{USER_NAME}}([^{]+){{\/USER_NAME}}/', $arBlockQuoteMatch, $arUserNameMatch);
                preg_match('/{{USER_DESC}}([^{]+){{\/USER_DESC}}/', $arBlockQuoteMatch, $arUserDescMatch);

                $arTmp = [
                    $arTextMatch[1],
                    strip_tags($arUserImgMatch[1]),
                    strip_tags($arUserNameMatch[1]),
                    strip_tags($arUserDescMatch[1]),
                ];

                list($strTextBlock, $strUserImg, $strUserName, $strUserDesc) = $arTmp;

                $arReplaceTo[] = <<<DOCHERE
<blockquote class="quote">
    <div class="text">
        $strTextBlock
    </div>
    <div class="image">
        <a href="/o-doktore/" target="_blank">
            <img src="$strUserImg" />
               $strUserName
            <span>$strUserDesc</span>
        </a>
    </div>
</blockquote>
DOCHERE;
            }

            $strText = str_replace($arReplaceFrom, $arReplaceTo, $strText);
        }

        return $strText;
    }
}