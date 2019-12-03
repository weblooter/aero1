<?
define('MAIN_PAGE', true);
define('DISABLE_BREADCRUMBS', true);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("TITLE", "Ведров Олег Вячеславович - пластический хирург");
$APPLICATION->SetPageProperty("description", "Ведров Олег Вячеславович - пластический хирург");
$APPLICATION->SetTitle("Главная");
?>
<? $APPLICATION->IncludeFile('include/main-first-block.php', false, ['SHOW_BORDER' => false])?>
<? $APPLICATION->IncludeFile('include/main-video-block.php', false, ['SHOW_BORDER' => false])?>
<? $APPLICATION->IncludeFile('include/main-advantages.php', false, ['MODE' => 'html']) ?>
<? $APPLICATION->IncludeComponent('local.core:main.services', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
<? $APPLICATION->IncludeComponent('local.core:main.patients', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
<? $APPLICATION->IncludeComponent('local.core:main.news', '.default', [], false, ['HIDE_ICONS' => 'Y']) ?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>