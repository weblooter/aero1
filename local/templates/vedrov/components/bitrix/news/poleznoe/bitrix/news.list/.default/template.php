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
    <div class="useful row row-f fadeup">
        <?foreach ($arResult['ITEMS'] as $arItem):?>
        <article class="col-xs-12 col-sm-6">
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="useful__item">
                <span class="image"><span style="background-image:url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);"></span></span>
                <span class="title"><?=$arItem['NAME']?></span>
            </a>
        </article>
        <?endforeach;?>
    </div>
</div>
<?=$arResult["NAV_STRING"]?>
