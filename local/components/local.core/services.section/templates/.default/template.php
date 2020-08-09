<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var ServicesSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */

?>

<section id="body" class="container">
    <div class="h1-title"><?=$GLOBALS['APPLICATION']->GetPageProperty('pre-h1')?></div>
    <h1><?=$arResult['SECTION']['NAME']?></h1>
    <div class="articles fadeup">
        <?
        foreach ($arResult['ITEMS'] as $arItems): ?>
            <article class="articles__item">
                <div class="image">
                    <a href="<?=$arItems['DETAIL_PAGE_URL']?>"><img src="<?=$arItems['IMG']?>" alt="" /></a>
                </div>
                <div class="text">
                    <h2><?=$arItems['NAME']?></h2>
                    <div class="desc">
                        <?=$arItems['DESC']?>
                    </div>
                    <div class="more"><a href="<?=$arItems['DETAIL_PAGE_URL']?>" class="arrow">Подробнее</a></div>
                </div>
            </article>
        <?
        endforeach; ?>
    </div>
</section>
