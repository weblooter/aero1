<?php


namespace Local\Core\Text\Format;

/**
 * Class FormatSnippetVideoBlock
 *
 * Форматирует снипет видеоблока
 *
 * @package Local\Core\Text\Format
 */
class FormatSnippetVideoBlock extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);
        $strText = (new FormatNewLine())->format($strText);

        if( preg_match_all('/(\{\{VIDEOBLOCK\}\}(.*?)\{\{\/VIDEOBLOCK\}\})/', $strText, $arVideoBlockMatches) > 0 )
        {
            $arVideoBlockMatches[0] = array_unique($arVideoBlockMatches[0]);

            $arReplaceFrom = $arVideoBlockMatches[0];
            $arReplaceTo = [];


            foreach ($arVideoBlockMatches[0] as $arVideoBlockMatch)
            {
                preg_match('/{{TITLE}}([^{]+){{\/TITLE}}/', $arVideoBlockMatch, $arTitleMatch);
                preg_match('/{{HEADER}}([^{]+){{\/HEADER}}/', $arVideoBlockMatch, $arHeaderMatch);
                preg_match('/{{IMG}}([^{]+){{\/IMG}}/', $arVideoBlockMatch, $arImgMatch);
                preg_match('/{{LINK}}([^{]+){{\/LINK}}/', $arVideoBlockMatch, $arLinkMatch);

                $arTmp = [
                    $arTitleMatch[1],
                    $arHeaderMatch[1],
                    $arImgMatch[1],
                    $arLinkMatch[1],
                ];
                $arTmp = array_map(function ($v){
                    return (new FormatTrim( new FormatStripTags() ))->format($v);
                }, $arTmp);

                list($strTitle, $strHeader, $strImg, $strLink) = $arTmp;

                $arReplaceTo[] = <<<DOCHERE
<section class="videos container post-up">
    <div class="videos__item">
        <div class="link">
            <div class="title-preview">$strTitle</div>
            <div class="h2">$strHeader</div>
            <img src="$strImg" alt=""/>
            <a data-mfp-src="$strLink" class="video-ico js-video-popup"></a>
        </div>
    </div>
</section>
DOCHERE;
            }

            $strText = str_replace($arReplaceFrom, $arReplaceTo, $strText);
        }

        return $strText;
    }
}