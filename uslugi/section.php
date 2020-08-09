<?
if( preg_match('/^\/uslugi\/([a-zA-Z0-9\-\_]+)\/([a-zA-Z0-9\-\_]+)\//', $_SERVER['SCRIPT_URL']) === 1 )
{
    define('MAIN_PAGE', true);
}
define('DISABLE_BREADCRUMBS', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Пластические операции у Ведрова Олега Вячеславовича ⭐⭐⭐⭐⭐ Лучший хирург 2020 года в Москве! Бесплатные консультации ✅ Доступные цены ✅ Тел. ☎️ +7 (905) 727-51-15");
$APPLICATION->SetPageProperty("title", "Пластические операции в Москва");
$APPLICATION->SetTitle("Услуги");
$APPLICATION->SetPageProperty('pre-h1',"Услуги");
$APPLICATION->SetPageProperty('h1',"Услуги");

$obRequest = \Bitrix\Main\Application::getInstance()
    ->getContext()
    ->getRequest();
?>
<? $APPLICATION->IncludeComponent('local.core:services.section', '.default', []);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>