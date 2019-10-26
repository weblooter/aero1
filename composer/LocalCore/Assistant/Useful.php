<?php


namespace Local\Core\Assistant;


class Useful
{
    /**
     * @param bool $boolPreH1
     * @param bool $boolH1
     */
    public static function showMobileHead($boolPreH1 = true, $boolH1 = true): void
    {
        ?>
        <div class="mobile-nav">
            <?
            if ($boolPreH1):?>
                <div class="h1-title"><?=$GLOBALS['APPLICATION']->GetPageProperty('pre-h1')?></div>
            <?endif; ?>
            <?
            if ($boolH1):?>
                <h1><?=$GLOBALS['APPLICATION']->GetPageProperty('h1')?></h1>
            <?endif; ?>
        </div>
        <?
    }

    /**
     * @param int $intIblockId
     * @param iny $intElemId
     *
     * @return array
     */
    public static function getPrevNexPages($intIblockId, $intElemId)
    {
        $arResult = [];
        $rsElems = \CIBlockElement::GetList(
            ['ACTIVE_FROM' => 'DESC', 'SORT' => 'ASC'],
            [
                'IBLOCK_ID' => $intIblockId,
                'ACTIVE' => 'Y'
            ],
            false,
            false,
            ['ID', 'NAME', 'IBLOCK_ID', 'DETAIL_PAGE_URL']
        );
        while ($ar = $rsElems->GetNext()) {
            if ($ar['ID'] < $intElemId) {
                $arResult['PREV'] = $ar['DETAIL_PAGE_URL'];
                break;
            } elseif ($ar['ID'] > $intElemId) {
                $arResult['NEXT'] = $ar['DETAIL_PAGE_URL'];
            }
        }

        return $arResult;
    }
}