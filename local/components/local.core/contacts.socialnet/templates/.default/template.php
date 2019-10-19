<?
/**
 * @var array                      $arParams
 * @var array                      $arResult
 * @var ContactsSocialNetComponent $component
 * @var CBitrixComponentTemplate   $this
 * @var string                     $templateName
 * @var string                     $componentPath
 * @var string                     $templateFolder
 * @global CMain                   $APPLICATION
 */
?>
<?
foreach ($arResult as $arItem) {
    $linkClass = '';
    switch ($arItem['CODE']) {
        case 'vk':
            $linkClass = 'vk';
            break;
        case 'instagram':
            $linkClass = 'inst';
            break;
        case 'youtube':
            $linkClass = 'yb';
            break;
    }
    ?>
    <a href="<?=$arItem['LINK']?>" class="<?=$linkClass?>" target="_blank"><?=$arItem['CODE']?></a>
    <?
}
?>
