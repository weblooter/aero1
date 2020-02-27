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
<? $GLOBALS['APPLICATION']->IncludeComponent('local.core:services.contacts', '.default', ['DATA' => $arResult]) ?>
