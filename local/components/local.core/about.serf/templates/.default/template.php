<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var AboutSerfComponent       $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */
?>
<? if (!empty($arResult)): ?>
    <div class="title-preview">Сертификаты и дипломы</div>
    <div class="grid gallery">
        <? foreach ($arResult as $arItem): ?>
            <div class="grid__item gallery__item"><a href="<?=$arItem['BIG']?>"><img src="<?=$arItem['SMALL']?>" alt="" /></a></div>
        <? endforeach; ?>
    </div>
<? endif; ?>