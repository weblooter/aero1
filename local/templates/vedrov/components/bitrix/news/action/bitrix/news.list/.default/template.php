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

    <section id="body" class="container">
        <div class="h1-title"><?=$GLOBALS['APPLICATION']->GetPageProperty('pre-h1')?></div>
        <h1><?=$GLOBALS['APPLICATION']->GetPageProperty('h1')?></h1>
        <div class="content">
            <div class="articles fadeup">
                <? foreach ($arResult['ITEMS'] as $arItem): ?>
                    <?
                    $arImt = [];
                    if ($arItem['PREVIEW_PICTURE']['ID'] > 0) {
                        $arImg = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], ['width' => 300, 'height' => 300], BX_RESIZE_IMAGE_EXACT);
                    }
                    ?>
                    <article class="articles__item">
                        <div class="image">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arImg['src']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" /></a>
                        </div>
                        <div class="text">
                            <h2><?=$arItem['NAME']?></h2>
                            <div class="desc">
                                <?=$arItem['PREVIEW_TEXT']?>
                            </div>
                            <div class="more"><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="arrow">Подробнее</a></div>
                        </div>
                    </article>
                <? endforeach; ?>
            </div>
        </div>
    </section>

<?=$arResult["NAV_STRING"]?>