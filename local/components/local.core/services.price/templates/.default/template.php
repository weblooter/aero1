<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var ServicesPriceComponent   $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */
?>

<section id="body" class="container">

    <div class="content inner">

        <?=$arResult['FIRST_BLOCK']?>
        <div class="line"></div>

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
                                    <? if ((int)$arItem['PROPERTIES']['DISCOUNT']['VALUE'] > 0): ?>
                                        <span class="price__discount" style="white-space: nowrap">
                                        <?=!empty($arItem['PROPERTIES']['PRINT_FROM']['VALUE']) ? '<font style="text-transform: lowercase">от </font>' : ''?><?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'][0], 0, '.', ' ')?> руб.
                                        </span>
                                        <span class="price__link" style="white-space: nowrap"><?=!empty($arItem['PROPERTIES']['PRINT_FROM']['VALUE']) ? '<font style="text-transform: lowercase">от </font>' : ''?><?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'][0] - (int)$arItem['PROPERTIES']['DISCOUNT']['VALUE'], 0, '.', ' ')?> руб.</span>
                                        <? if (!empty(trim($arItem['PROPERTIES']['DISCOUNT_TITLE']['VALUE']))): ?>
                                            <span class="price__discount-text"><?=$arItem['PROPERTIES']['DISCOUNT_TITLE']['VALUE']?></span>
                                        <? endif; ?>
                                    <? else: ?>
                                        <span class="price__link" style="white-space: nowrap"><?=!empty($arItem['PROPERTIES']['PRINT_FROM']['VALUE']) ? '<font style="text-transform: lowercase">от </font>' : ''?><?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'][0], 0, '.', ' ')?> руб.</span>
                                    <? endif; ?>
                                    <div class="price__text">
                                        <table>
                                            <? foreach ($arItem['PROPERTIES']['PRICE']['VALUE'] as $k => $v): ?>
                                                <tr>
                                                    <td><?=$arItem['PROPERTIES']['PRICE']['DESCRIPTION'][$k]?></td>
                                                    <td>
                                                        <? if ($k == 0 && (int)$arItem['PROPERTIES']['DISCOUNT']['VALUE'] > 0): ?>
                                                            <span class="price__text__del"><?=number_format($v, 0, '.', '.')?> руб.</span>
                                                            <br />
                                                            <?=number_format($v - (int)$arItem['PROPERTIES']['DISCOUNT']['VALUE'], 0, '.', '.')?> руб.
                                                        <? else: ?>
                                                            <?=number_format($v, 0, '.', '.')?> руб.
                                                        <? endif; ?>
                                                    </td>
                                                </tr>
                                            <? endforeach; ?>
                                            <tr>
                                                <td>ИТОГО</td>
                                                <td style="white-space: nowrap">
                                                    <? if ((int)$arItem['PROPERTIES']['DISCOUNT']['VALUE'] > 0): ?>
                                                        <span class="price__text__del"><?=!empty($arItem['PROPERTIES']['PRINT_FROM']['VALUE']) ? '<font style="text-transform: lowercase">от </font>' : ''?><?=number_format($intPrice, 0, '.', '.')?> руб.</span>
                                                        <br />
                                                        <?=!empty($arItem['PROPERTIES']['PRINT_FROM']['VALUE']) ? '<font style="text-transform: lowercase">от </font>' : ''?><?=number_format($intPrice - (int)$arItem['PROPERTIES']['DISCOUNT']['VALUE'], 0, '.', '.')?> руб.
                                                    <? else: ?>
                                                        <?=!empty($arItem['PROPERTIES']['PRINT_FROM']['VALUE']) ? '<font style="text-transform: lowercase">от </font>' : ''?><?=number_format($intPrice, 0, '.', '.')?> руб.
                                                    <? endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="more">
                            <a href="<?=$arResult['ABOUT_OPERATION']?>" class="arrow">Об операции</a>
                            <span class="arrow js-open-callback-form">Бесплатная консультация</span>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        <? endforeach; ?>

        <? if (!empty($arResult['SECOND_BLOCK'])): ?>
            <?=$arResult['SECOND_BLOCK']?>
            <div class="line"></div>
        <? endif; ?>

    </div>
    <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:consult.free-consult', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
</section>
