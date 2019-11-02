<?
/**
 * @var array                    $arParams
 * @var array                    $arResult
 * @var ServicesComponent        $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 * @global CMain                 $APPLICATION
 */
?>
<? if (
    \Bitrix\Main\Application::getInstance()
        ->getContext()
        ->getRequest()
        ->get('REVIEW_ID') > 0
): ?>
    <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:services.review.detail', '.default', [
        'DATA' => $arResult,
        'REVIEW_ID' => \Bitrix\Main\Application::getInstance()
            ->getContext()
            ->getRequest()
            ->get('REVIEW_ID')
    ]) ?>
<? else: ?>
    <? $GLOBALS['APPLICATION']->IncludeComponent('local.core:services.review', '.default', ['DATA' => $arResult]) ?>
<? endif; ?>
