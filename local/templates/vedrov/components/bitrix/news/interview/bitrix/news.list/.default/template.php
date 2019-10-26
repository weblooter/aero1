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
<? \Local\Core\Assistant\Useful::showMobileHead() ?>
<div class="content">
    <div class="row row-f blog">
        <?foreach ($arResult['ITEMS'] as $arItem):?>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="blog__item">
                <span class="image"><img src="<?=( !empty( $arItem['PREVIEW_PICTURE']['SRC'] ) ) ? $arItem['PREVIEW_PICTURE']['SRC'] : '/img/logo-grey-s.png'?>" /></span>
                <span class="title"><?=$arItem['NAME']?></span>
                <span class="author">Ведров О. В.</span>
            </a>
        </div>
        <?endforeach;?>
    </div>
</div>
<?=$arResult["NAV_STRING"]?>
