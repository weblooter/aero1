<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Ведров Олег Вячеславович отвечает на вопросы посетителей сайта в режиме online. Ответ на вопрос может занять несколько дней, т.к. хирург отвечает в свободное от операций время.");
$APPLICATION->SetPageProperty("title", "Консультации-онлайн с Ведровым Олегом Вячеславовичем");
$APPLICATION->SetPageProperty("pre-h1", "КОНСУЛЬТАЦИИ ОНЛАЙН");
$APPLICATION->SetPageProperty("h1", "Задайте свой вопрос<br/>Ведрову Олегу Вячеславовичу");
$APPLICATION->SetTitle("Консультации");
?>
<? $APPLICATION->IncludeComponent('local.core:consult.index', '.default', [])?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>