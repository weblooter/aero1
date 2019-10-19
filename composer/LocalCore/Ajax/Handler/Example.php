<?php

namespace Local\Core\Ajax\Handler;
use \Local\Core\Inner\BxModified;


class Example
{
    public static function echoRed(\Bitrix\Main\HttpRequest $obRequest, \Local\Core\Inner\BxModified\HttpResponse $obResponse, $args)
    {
        $arResponse = [];
        $obResult = new \Bitrix\Main\Result();

        // Logic ...

        if( $obResult->isSuccess() )
        {
            $obResponse->setSuccessAjaxResult($obResult->getData());
        }
        else
        {
            $obResponse->setErrorAjaxResult([], $obResult->getErrorMessages());
        }
    }
}