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
    <h1><?=$arResult['NAME']?></h1>
    <div class="content">
        <?
        $arImg = [];
        if ($arResult['DETAIL_PICTURE']['ID'] > 0) {
            $arImg = \CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], ['width' => 600, 'height' => 600], BX_RESIZE_IMAGE_PROPORTIONAL);
        }
        ?>
        <div class="image-right"><img src="<?=$arImg['src']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" /></div>
        <?=$arResult['DETAIL_TEXT']?>
        <div class="back">
            <a href="<?=$arParams['WBL_BACK_PAGE']?>" class="prev arrow">Вернуться к списку</a>
        </div>
</section>
