<?php

namespace Local\Core\Ajax\Handler;

use Local\Core\Text\Format;

/**
 * Class Services
 *
 * @package Local\Core\Ajax\Handler\Consult
 */
class Services
{
    /**
     * Обработчик формы с отзывом на детальной станице отзыва в услугах
     *
     * @param \Bitrix\Main\HttpRequest                  $obRequest
     * @param \Local\Core\Inner\BxModified\HttpResponse $obResponse
     * @param                                           $args
     */
    public static function createReview(\Bitrix\Main\HttpRequest $obRequest, \Local\Core\Inner\BxModified\HttpResponse $obResponse, $args)
    {
        $arResponse = [];

        try {

            if (empty(trim($obRequest->getPost('NAME'))) || empty($obRequest->getPost('MSG'))) {
                throw new \Exception('Заполнены не все данные.');
            }

            $el = new \CIBlockElement();
            $arLoadProductArray = [
                'ACTIVE_FROM' => date('d.m.Y'),
                "IBLOCK_ID" => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'useful_patient'),
                "PROPERTY_VALUES" => [
                    'REVIEW_NAME' => trim($obRequest->getPost('NAME')),
                    'REVIEW_TEXT' => ['VALUE' => ['TYPE' => 'TEXT', 'TEXT' => (new Format\FormatTrim(new Format\FormatStripTags()))->format($obRequest->getPost('MSG'))]]
                ],
                "NAME" => date('Y-m-d H:i').' | '.$obRequest->getPost('NAME').' | '.$obRequest->getPost('EMAIL'),
                "ACTIVE" => "N"
            ];

            $arLoadProductArray['CODE'] = \Cutil::translit($arLoadProductArray['NAME'], "ru", array("replace_space" => "-", "replace_other" => "-"));

            if (!empty($obRequest->getFile('ATTACHMENT'))) {

                /** @var $arFiles array */
                $arFiles = $obRequest->getFile('ATTACHMENT');
                ksort($arFiles);

                foreach ($arFiles['error'] as $k => $v) {
                    if ($v < 1) {
                        $arLoadProductArray['PROPERTY_VALUES']['PHOTOS'][] = ['VALUE' => array_combine(array_keys($arFiles), array_column($arFiles, $k)), 'DESCRIPTION' => ''];
                    }
                }
            }

            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {

                $obResponse->setSuccessAjaxResult(['ID' => $PRODUCT_ID]);

                \Local\Core\TriggerMail\Services::createReview([
                    'FIO' => trim($obRequest->getPost('NAME')),
                    'EMAIL' => trim($obRequest->getPost('EMAIL')),
                    'MSG' => (new Format\FormatTrim(new Format\FormatStripTags()))->format($obRequest->getPost('MSG')),
                    'ELEM_ID' => $PRODUCT_ID
                ]);


            } else {
                throw new \Exception($el->LAST_ERROR);
            }

        } catch (\Exception $e) {
            $obResponse->setErrorAjaxResult([], [$e->getMessage()]);
        }
    }
}