<?php


namespace Local\Core\Text\Format;

/**
 * Class FormatSnippetServiceVideo
 *
 * Форматирует снипет видео в услугах
 *
 * @package Local\Core\Text\Format
 */
class FormatSnippetServiceVideo extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);
        $strText = (new FormatNewLine())->format($strText);

        if (preg_match_all('/(\{\{SERVICEVIDEO\}\}(.*?)\{\{\/SERVICEVIDEO\}\})/', $strText, $arVideoBlockMatches) > 0) {
            $arVideoBlockMatches[0] = array_unique($arVideoBlockMatches[0]);

            $arReplaceFrom = $arVideoBlockMatches[0];
            $arReplaceTo = [];


            foreach ($arVideoBlockMatches[0] as $arVideoBlockMatch) {
                preg_match('/{{TITLE}}([^{]+){{\/TITLE}}/', $arVideoBlockMatch, $arTitleMatch);
                preg_match('/{{HEADER}}([^{]+){{\/HEADER}}/', $arVideoBlockMatch, $arHeaderMatch);
                preg_match('/{{IMG}}([^{]+){{\/IMG}}/', $arVideoBlockMatch, $arImgMatch);
                preg_match('/{{LINK}}([^{]+){{\/LINK}}/', $arVideoBlockMatch, $arLinkMatch);
                preg_match('/{{DESCRIPTION}}([^{]+){{\/DESCRIPTION}}/', $arVideoBlockMatch, $arDescriptionMatch);

                $arTmp = [
                    $arTitleMatch[1],
                    $arHeaderMatch[1],
                    $arImgMatch[1],
                    $arLinkMatch[1],
                    $arDescriptionMatch[1],
                ];
                $arTmp = array_map(function ($v)
                    {
                        return (new FormatTrim(new FormatStripTags()))->format($v);
                    }, $arTmp);

                list($strTitle, $strHeader, $strImg, $strLink, $strDescription) = $arTmp;

                if (preg_match('/^\/uslugi\/([a-zA-Z0-9\-\_]+)\/([a-zA-Z0-9\-\_]+)$/', \Bitrix\Main\Application::getInstance()
                        ->getContext()
                        ->getRequest()
                        ->getRequestedPageDirectory()) === 1
                ) {
                    $arReplaceTo[] = <<<DOCHERE
<div class="video">
<div class="video__item">
    <div class="video__item__text">
        <div class="title-preview">$strTitle</div>
        <div class="h2">$strHeader</div>
    </div>
    <div class="link">
        <div class="title-preview">$strTitle</div>
        <div class="h2">$strHeader</div>
        <img src="$strImg"/>
        <a data-mfp-src="$strLink" class="video-ico js-video-popup"></a>
    </div>
</div>
<p>$strDescription</p>
</div>
DOCHERE;
                } else {
                    $arReplaceTo[] = <<<DOCHERE
<div class="videoList__item">
    <div class="videoList__item__text">
        <div class="title-preview">$strTitle</div>
        <div class="h2">$strHeader</div>
    </div>
    <div class="link">
        <div class="title-preview">$strTitle</div>
        <div class="h2">$strHeader</div>
        <img src="$strImg"/>
        <a data-mfp-src="$strLink" class="video-ico js-video-popup"></a>
    </div>
</div>
<p>$strDescription</p>
DOCHERE;
                }
            }

            $strText = str_replace($arReplaceFrom, $arReplaceTo, $strText);
        }

        return $strText;
    }
}