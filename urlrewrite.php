<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#",
		"RULE" => "componentName=\$1",
		"ID" => "",
		"PATH" => "/bitrix/services/mobileapp/jn.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/aktsii/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/aktsii/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/rest/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/rest/index.php",
		"SORT" => "100",
	),
);
?>