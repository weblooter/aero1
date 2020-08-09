<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var FooterSocialNetComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */

?>

<div class="social">
    <?
    foreach ($arResult as $arItem) {
        $imgSrc = '';
        switch ($arItem['CODE']) {
            case 'vk':
                $imgSrc = '/img/svg/vk.svg#white';
                break;
            case 'instagram':
                $imgSrc = '/img/svg/instagram.svg#white';
                break;
            case 'youtube':
                $imgSrc = '/img/svg/yb.svg#white';
                break;
            case 'telegram':
                $imgSrc = '/img/svg/telegram.svg#white';
                break;
        }
        ?>
        <a href="<?=$arItem['LINK']?>" target="_blank"><img src="<?=$imgSrc?>" width="30" height="30px" alt="" /></a>
        <?
    }
    ?>
</div>
