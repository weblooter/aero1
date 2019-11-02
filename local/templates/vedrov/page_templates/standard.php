<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
$APPLICATION->SetPageProperty("pre-h1", "pre h1");
$APPLICATION->SetPageProperty("h1", "H1");
?>
    <div class="content">
        Текст страницы
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>