<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<? \Local\Core\Assistant\Useful::showMobileHead(true, false) ?>
<div class="content">
    <div class="h1-bg" style="background-image:url(<?=$arResult['DETAIL_PICTURE']['SRC']?>);">
        <div class="date"><?=$arResult['DISPLAY_ACTIVE_FROM']?></div>
        <h1><?=$arResult['NAME']?></h1>
    </div>
    <?
    switch (mb_strtoupper($arResult['DETAIL_TEXT_TYPE'])) {
        case 'HTML':
            echo $arResult['DETAIL_TEXT'];
            break;
        case 'TEXT':
            echo '<p>'.$arResult['DETAIL_TEXT'].'</p>';
            break;
    }
    ?>
    <? if (!empty($arResult['PROPERTIES']['PHOTO']['VALUE'])): ?>
        <div class="gallerySlider post-up">
            <div class="title-preview">Фотогалерея</div>
            <div class="gallery-container">
                <div class="gallery js-slider-photo">
                    <?
                    foreach ($arResult['PROPERTIES']['PHOTO']['VALUE'] as $intId):
                        $arThumb = \CFile::ResizeImageGet($intId, ['width' => 900, 'height' => 600], BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 75);
                        ?>
                        <div class="slide"><a href="javascript:void(0)"><img src="<?=$arThumb['src']?>" /></a></div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    <? endif; ?>
    <div class="back">
        <? if ($arResult['PREV']): ?>
            <a href="<?=$arResult['PREV']?>" class="prev arrow">Предыдущая новость</a>
        <? endif; ?>
        <? if ($arResult['NEXT']): ?>
            <a href="<?=$arResult['NEXT']?>" class="next arrow">Следующая новость</a>
        <? endif; ?>
    </div>
</div>