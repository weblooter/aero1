<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arSections = []; global $LastSection; $LastSection = [];
foreach ($arResult['arMap'] as $arSect) {
    global $LastSection;
    if( $arSect['LEVEL'] == 0 ){
        $arSections[ $arSect['FULL_PATH'] ] = $arSect;
        $LastSection[ $arSect['LEVEL'] ] =& $arSections[ $arSect['FULL_PATH'] ];
    }else{
        $LastSection[ $arSect['LEVEL']-1 ]['CHILDS'][ $arSect['FULL_PATH'] ] = $arSect;
        $LastSection[ $arSect['LEVEL'] ] =& $LastSection[ $arSect['LEVEL']-1 ]['CHILDS'][ $arSect['FULL_PATH'] ];
    }
}

$arResult = $arSections;
unset($arSections);

class WblSitemap {
    public static function printLvl($arMenu, $intLvl = 0)
    {
        ?>
        <ol class="<?=$intLvl===0 ? 'sitemap' : ''?>">
            <?
            foreach ($arMenu as $arLvl)
            {
                echo '<li>';
                echo '<a href="'.$arLvl['FULL_PATH'].'">'.$arLvl['NAME'].'</a>';
                if( !empty( $arLvl['CHILDS'] ) )
                {
                    self::printLvl($arLvl['CHILDS'], $intLvl+1);
                }
                echo '</li>';
            }
            ?>
        </ol>
        <?
    }
}

\WblSitemap::printLvl($arResult);