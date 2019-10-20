<?
$GLOBALS['APPLICATION']->SetPageProperty('h1', $arResult['SECTION']['SEO_VALUES']['SECTION_PAGE_TITLE']);
$GLOBALS['APPLICATION']->AddChainItem($arResult['SECTION']['NAME']);
$GLOBALS['APPLICATION']->SetTitle($arResult['SECTION']['SEO_VALUES']['SECTION_META_TITLE'].( $arResult['NAV']->getCurrentPage() > 1  ? ' - страница '.$arResult['NAV']->getCurrentPage() : ''));
$GLOBALS['APPLICATION']->SetPageProperty('title', $arResult['SECTION']['SEO_VALUES']['SECTION_META_TITLE'].( $arResult['NAV']->getCurrentPage() > 1  ? ' - страница '.$arResult['NAV']->getCurrentPage() : ''));
$GLOBALS['APPLICATION']->SetPageProperty('description', $arResult['SECTION']['SEO_VALUES']['SECTION_META_DESCRIPTION']);
$GLOBALS['APPLICATION']->SetPageProperty('keywords', $arResult['SECTION']['SEO_VALUES']['SECTION_META_KEYWORDS']);