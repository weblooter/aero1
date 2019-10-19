<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var AboutHistoryComponent    $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */
?>

<? foreach ($arResult as $arSection): ?>
    <?
    $strIcon = false;
    switch ($arSection['CODE']) {
        case 'AD':
            $strIcon = 'ico ico-hat';
            break;

        case 'KVAL':
            $strIcon = 'ico ico-man';
            break;

        case 'HAG':
            $strIcon = 'ico ico-cup';
            break;
    }
    ?>
    <div class="title-preview"><?=$arSection['NAME']?>> <?=($strIcon) ? '<span class="'.$strIcon.'"></span>' : ''?></div>
    <table>
        <? foreach ($arSection['ITEMS'] as $arItem): ?>
            <tr>
                <td><?=$arItem['NAME']?>></td>
                <td><?=$arItem['PREVIEW_TEXT']?></td>
            </tr>
        <? endforeach; ?>
    </table>
<? endforeach; ?>
<div class="title-preview">Проводимые операции <span class="ico ico-hand"></span></div>
<div class="balls">
    <ul>
        <li>липосакция</li>
        <li>VASER</li>
        <li>блефаропластика</li>
        <li>маммопластика</li>
        <li>пластика лица</li>
        <li>пластика тела</li>
        <li>интимная пластика</li>
    </ul>
</div>
