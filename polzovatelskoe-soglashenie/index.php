<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пользовательское соглашение");
$APPLICATION->SetPageProperty("pre-h1", "pre h1");
$APPLICATION->SetPageProperty("h1", "H1");
?><div class="content">
<?
$APPLICATION->IncludeFile('include/footer-license.php', false, ['MODE' => 'html']);
?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>