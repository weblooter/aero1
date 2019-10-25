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
}