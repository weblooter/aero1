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

$arrResult = [];

$obCache = \Bitrix\Main\Application::getInstance()->getCache();
if( $obCache->startDataCache(60*60*24, __FILE__.'#'.__LINE__) )
{
    $rsSections = \CIBlockSection::GetList(['SORT' => 'ASC', 'ID' => 'DESC'], ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'DEPTH_LEVEL' => 1, 'ACTIVE' => 'Y'], false, ['ID', 'IBLOCK_ID', 'PICTURE', 'DESCRIPTION', 'SECTION_PAGE_URL']);

    if( $rsSections->SelectedRowsCount() < 1 )
    {
        $obCache->abortDataCache();
    }
    else
    {
        while ($ar = $rsSections->GetNext())
        {
            if( $ar['PICTURE'] > 0 )
            {
                $arTmp = \CFile::ResizeImageGet($ar['PICTURE'], ['width' => 350, 'height' => 350], BX_RESIZE_IMAGE_EXACT, false,false,false,75);
                $ar['PICTURE'] = $arTmp['src'];
            }
            $arrResult['ITEMS'][] = $ar;
        }
        $obCache->endDataCache($arrResult);
    }
}
else
{
    $arrResult = $obCache->getVars();
}

$this->setFrameMode(true);
?>
<section id="body" class="container">
    <div class="h1-title"><?=$GLOBALS['APPLICATION']->GetPageProperty('pre-h1')?></div>
    <h1><?=$GLOBALS['APPLICATION']->GetPageProperty('h1')?></h1>
    <div class="content">
        <div class="articles fadeup">
            <?foreach ($arrResult['ITEMS'] as $arItem):?>
                <article class="articles__item">
                    <div class="image">
                        <a href="<?=$arItem['SECTION_PAGE_URL']?>"><img src="<?=$arItem['PICTURE']?>"/></a>
                    </div>
                    <div class="text">
                        <h2><?=$arItem['NAME']?></h2>
                        <div class="desc">
                            <?=$arItem['DESCRIPTION']?>
                        </div>
                        <div class="more"><a href="<?=$arItem['SECTION_PAGE_URL']?>" class="arrow">Смотреть фото работ</a></div>
                    </div>
                </article>
            <?endforeach;?>
        </div>
    </div>
</section>
