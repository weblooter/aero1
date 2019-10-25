<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?\Local\Core\Assistant\Useful::showMobileHead(true, false)?>
<div class="content">
    <div class="h1-bg" style="background-image:url(<?=$arResult['DETAIL_PICTURE']['SRC']?>);"><h1><?=$arResult['NAME']?></h1></div>
    <div class="text col2">
        <?
        switch (mb_strtoupper($arResult['DETAIL_TEXT_TYPE']))
        {
            case 'HTML':
                echo $arResult['DETAIL_TEXT'];
                break;
            case 'TEXT':
                echo '<p>'.$arResult['DETAIL_TEXT'].'</p>';
                break;
        }
        ?>
    </div>
    <?if( !empty($arResult['PROPERTIES']['PHOTO']['VALUE']) ):?>
        <div class="grid gallery">
            <?
            foreach ($arResult['PROPERTIES']['PHOTO']['VALUE'] as $intId):
                $arThumb = \CFile::ResizeImageGet($intId, ['width' => 600, 'height' => 1000], BX_RESIZE_IMAGE_PROPORTIONAL, false,false,false,75);
            ?>
            <div class="grid__item gallery__item"><a href="<?=\CFile::GetPath($intId)?>"><img src="<?=$arThumb['src']?>"/></a></div>
            <?endforeach;?>
        </div>
    <?endif;?>
    <div class="back">
        <?if( $arResult['PREV'] ):?>
            <a href="<?=$arResult['PREV']?>" class="prev arrow">Предыдущая статья</a>
        <?endif;?>
        <?if( $arResult['NEXT'] ):?>
            <a href="<?=$arResult['NEXT']?>" class="next arrow">Следующая статья</a>
        <?endif;?>
    </div>
</div>