<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var PricesIndexComponent     $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */
?>
<section id="body" class="container">
    <div class="h1-title"><?=$GLOBALS['APPLICATION']->GetPageProperty('pre-h1')?></div>
    <h1><?=$GLOBALS['APPLICATION']->GetPageProperty('h1')?></h1>
    <div class="content">
        <? foreach ($arResult['SECTIONS'] as $arSection): ?>
            <div class="title-preview"><?=$arSection['NAME']?></div>
            <div class="prices">
                <? foreach ($arResult['ITEMS'][$arSection['ID']] as $arItem): ?>
                    <div class="prices__item">
                        <h3><?=$arItem['NAME']?></h3>
                        <div class="row row-f">
                            <div class="text col-xs-12 col-md-6">
                                <?=$arItem['PREVIEW_TEXT']?>
                            </div>
                            <div class="price col-xs-12 col-md-6">
                                <div class="price__item">
                                    <?
                                    $intPrice = array_sum($arItem['PROPERTIES']['PRICE']['VALUE']);
                                    ?>
                                    <span class="price__link"><?=number_format($intPrice, 0, '.', ' ')?> руб.</span>
                                    <div class="price__text">
                                        <table>
                                            <? foreach ($arItem['PROPERTIES']['PRICE']['VALUE'] as $k => $v): ?>
                                                <tr>
                                                    <td><?=$arItem['PROPERTIES']['PRICE']['DESCRIPTION'][$k]?></td>
                                                    <td><?=number_format($v, 0, '.', '.')?> руб.</td>
                                                </tr>
                                            <? endforeach; ?>
                                            <tr>
                                                <td>ИТОГО</td>
                                                <td><?=number_format($intPrice, 0, '.', '.')?> руб.</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="more">
                            <? if ($arItem['PROPERTIES']['OPERATION']['VALUE'] > 0): ?>
                                <a href="<?=$arResult['OPERATIONS'][$arItem['PROPERTIES']['OPERATION']['VALUE']]?>" class="arrow">Об операции</a>
                            <? endif; ?>
                            <span class="arrow js-open-callback-form">Бесплатная консультация</span>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        <? endforeach; ?>

    </div>
    <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.free-consult', '.default', [], false, ['HIDE_ICON' => 'Y']) ?>
</section>