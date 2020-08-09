<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var MainServicesComponent    $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */

?>
<?
if (!empty($arResult['ITEMS'])): ?>
    <section class="services container">
        <div class="title-preview post-up"><?
            $APPLICATION->IncludeFile('include/main-services-title.php', false, ['MODE' => 'text']) ?></div>
        <div class="h2 post-up"><?
            $APPLICATION->IncludeFile('include/main-services-text.php', false, ['MODE' => 'text']) ?></div>
        <div class="row row-f square">
            <?
            foreach ($arResult['ITEMS'] as $arSection): ?>
                <div class="col-xs-6 col-md-3">
                    <div class="services__item" style="background-image: url(<?=$arSection['PICTURE']?>);">
                        <div class="title"><?=$arSection['NAME']?></div>
                        <div class="title-hover"><?=$arSection['NAME']?></div>
                        <div class="desc">
                            <?
                            foreach ($arSection['ITEMS'] as $arItem): ?>
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                            <?
                            endforeach; ?>
                        </div>
                    </div>
                </div>
            <?
            endforeach; ?>
        </div>
    </section>
<?
endif; ?>