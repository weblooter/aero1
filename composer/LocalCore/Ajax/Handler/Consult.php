<?php

namespace Local\Core\Ajax\Handler;

/**
 * Class Consult
 *
 * @package Local\Core\Ajax\Handler\Consult
 */
class Consult
{
    /**
     * Обработчик формы "Задать вопрос онлайн" на всех страницах сайта внизу
     *
     * @param \Bitrix\Main\HttpRequest                  $obRequest
     * @param \Local\Core\Inner\BxModified\HttpResponse $obResponse
     * @param                                           $args
     */
    public static function shortForm(\Bitrix\Main\HttpRequest $obRequest, \Local\Core\Inner\BxModified\HttpResponse $obResponse, $args)
    {
        $arResponse = [];

        try {
            if (empty($obRequest->getPost('NAME')) || empty($obRequest->getPost('PHONE'))) {
                throw new \Exception('Не полный данные!');
            }

            $strMsg = 'Заказан звонок.'.PHP_EOL;
            $strMsg .= 'Имя: '.$obRequest->getPost('NAME').PHP_EOL;
            $strMsg .= 'Телефон: '.$obRequest->getPost('PHONE').PHP_EOL;

            $el = new \CIBlockElement();
            $arLoadProductArray = [
                'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'system-consult-short-form'),
                'NAME' => date('Y-m-d H:i').' | '.$obRequest->getPost('NAME'),
                'PREVIEW_TEXT' => $strMsg,
                'PREVIEW_TEXT_TYPE' => 'text'
            ];

            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $obResponse->setSuccessAjaxResult(['ID' => $PRODUCT_ID]);

                \Local\Core\TriggerMail\Consult::shortForm(['MSG' => str_replace(PHP_EOL, '<br/>', $strMsg)]);
            } else {
                throw new \Exception($el->LAST_ERROR);
            }
        } catch (\Exception $e) {
            $obResponse->setErrorAjaxResult([], [$e->getMessage()]);
        }
    }

    /**
     * Обработчик формы "Задать вопрос" на страницах консультации
     *
     * @param \Bitrix\Main\HttpRequest                  $obRequest
     * @param \Local\Core\Inner\BxModified\HttpResponse $obResponse
     * @param                                           $args
     */
    public static function createAnswer(\Bitrix\Main\HttpRequest $obRequest, \Local\Core\Inner\BxModified\HttpResponse $obResponse, $args)
    {
        $arResponse = [];

        try {

            if (empty(trim($obRequest->getPost('NAME'))) || empty(trim($obRequest->getPost('EMAIL'))) || empty($obRequest->getPost('CATEGORY_ID')) || empty($obRequest->getPost('MSG'))) {
                throw new \Exception('Заполнены не все данные.');
            }

            $el = new \CIBlockElement();
            $arLoadProductArray = [
                "IBLOCK_SECTION_ID" => $obRequest->getPost('CATEGORY_ID'),
                'ACTIVE_FROM' => date('d.m.Y'),
                "IBLOCK_ID" => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                "PROPERTY_VALUES" => [
                    'ASKER_NAME' => trim($obRequest->getPost('NAME')),
                    'ASKER_EMAIL' => trim($obRequest->getPost('EMAIL'))
                ],
                "NAME" => date('Y-m-d H:i').' | '.$obRequest->getPost('NAME'),
                "ACTIVE" => "N",
                "PREVIEW_TEXT" => $obRequest->getPost('MSG'),
                "PREVIEW_TEXT_TYPE" => "text",
            ];

            if (!empty($obRequest->getFile('ATTACHMENT')) && $obRequest->getFile('ATTACHMENT')['error'] < 1) {
                $arLoadProductArray['PROPERTY_VALUES']['ATTACHMENT_PHOTO'] = ['VALUE' => $obRequest->getFile('ATTACHMENT')];
            }

            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {

                $obResponse->setSuccessAjaxResult(['ID' => $PRODUCT_ID]);

                \Local\Core\TriggerMail\Consult::createAnswer([
                    'FIO' => trim($obRequest->getPost('NAME')),
                    'EMAIL' => trim($obRequest->getPost('EMAIL')),
                ]);

            } else {
                throw new \Exception($el->LAST_ERROR);
            }

        } catch (\Exception $e) {
            $obResponse->setErrorAjaxResult([], [$e->getMessage()]);
        }
    }
}