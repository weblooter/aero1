<?php


namespace Local\Core\Text\Format;

/**
 * Class FormatSnippetPhotoGallery
 *
 * Форматирует снипет фотогалереи
 *
 * @package Local\Core\Text\Format
 */
class FormatSnippetPhotoGallery extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);
        $strText = (new FormatNewLine())->format($strText);

        if( preg_match_all('/(\{\{PHOTOGALLERY\}\}(.*?)\{\{\/PHOTOGALLERY\}\})/', $strText, $arPhotoGalleryMatches) > 0 )
        {
            $arPhotoGalleryMatches[0] = array_unique($arPhotoGalleryMatches[0]);

            $arReplaceFrom = $arPhotoGalleryMatches[0];
            $arReplaceTo = [];


            foreach ($arPhotoGalleryMatches[0] as $arPhotoGalleryMatch)
            {
                preg_match_all('/{{IMG}}([^{]+){{\/IMG}}/', $arPhotoGalleryMatch, $arImgMatches);

                $arImgMatches[1] = array_map(function ($v){
                    return (new FormatTrim( new FormatStripTags() ))->format($v);
                }, $arImgMatches[1]);

                $strHtml = '<div class="gallerySlider post-up"><div class="title-preview">Фотогалерея</div><div class="gallery-container"><div class="gallery js-slider-photo">';
                foreach ($arImgMatches[1] as $strImg)
                {
                    $strHtml .= '<div class="slide"><a href="javascript:void(0)"><img src="'.$strImg.'" /></a></div>';
                }
                $strHtml .= '</div></div></div>';

                $arReplaceTo[] = $strHtml;
            }

            $strText = str_replace($arReplaceFrom, $arReplaceTo, $strText);
        }

        return $strText;
    }
}