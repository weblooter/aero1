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
<div class="vw-container">
    <div class="gallerySquare square">
        <? foreach ($arResult['ITEMS'] as $arItem): ?>
            <div class="gallerySquare__item">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
                    <span class="arrow">Подробнее</span>
                </a>
            </div>
        <? endforeach; ?>
    </div>
</div>