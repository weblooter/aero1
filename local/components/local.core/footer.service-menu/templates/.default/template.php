<?
/**
 * @var array                      $arParams
 * @var array                      $arResult
 * @var FooterServiceMenuComponent $component
 * @var CBitrixComponentTemplate   $this
 * @var string                     $templateName
 * @var string                     $componentPath
 * @var string                     $templateFolder
 * @global CMain                   $APPLICATION
 */

?>
<?
foreach ($arResult['SERVICES'] as $arSection): ?>
    <div class="col-xs-6 col-md-3">
        <div class="footer__title">
            <?=$arSection['NAME']?>
        </div>
        <ul>
            <?
            foreach ($arSection['CHILD'] as $arChild): ?>
                <li><a href="<?=$arChild['DETAIL_PAGE_URL']?>"><?=$arChild['NAME']?></a></li>
            <?
            endforeach; ?>
        </ul>
    </div>
<?
endforeach; ?>
