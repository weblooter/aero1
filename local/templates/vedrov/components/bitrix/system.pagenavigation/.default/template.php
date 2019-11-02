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

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false)) {
        return;
    }
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<? if ($arResult["bDescPageNumbering"] === true): ?>


    <div class="paging">
        <? while ($arResult["nStartPage"] >= $arResult["nEndPage"]): ?>
            <? $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1; ?>

            <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                <strong><?=$NavRecordGroupPrint?></strong>
            <? elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false): ?>
                <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>
            <? else: ?>
                <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
            <? endif ?>

            <? $arResult["nStartPage"]-- ?>
        <? endwhile ?>
    </div>

<? else: ?>
    <div class="paging">

        <? while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>

            <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                <strong><?=$arResult["nStartPage"]?></strong>
            <? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
                <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
            <? else: ?>
                <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
            <? endif ?>
            <? $arResult["nStartPage"]++ ?>
        <? endwhile ?>

    </div>

<? endif ?>