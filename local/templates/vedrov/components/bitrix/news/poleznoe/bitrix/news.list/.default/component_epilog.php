<?
$obRequest = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
if( $obRequest->get('PAGEN_1') == 1 )
{
    LocalRedirect($obRequest->getRequestedPageDirectory().'/');
}
elseif( $obRequest->get('PAGEN_1') > 1 )
{
    $GLOBALS['APPLICATION']->SetPageProperty('title', $GLOBALS['APPLICATION']->GetTitle().' - Страница '.$obRequest->get('PAGEN_1'));
}