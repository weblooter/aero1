<?php

namespace Local\Core\EventHandlers\Iblock;

use Local\Core\Text\Format;

class OnAfterIBlockElementUpdate
{

    /**
     * Проверка состояния активности вопроса ИБ "консультация".<br/>
     * Если елемент стал активным и заполнен детальный текст - отправляем почту.
     *
     * @param $arFields
     *
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function consultRegisterActiveState(&$arFields)
    {
        if ($arFields['ID'] > 0) {
            $rsElemData = \Bitrix\Iblock\ElementTable::getList([
                'filter' => [
                    'ID' => $arFields['ID']
                ],
                'select' => [
                    'ID',
                    'IBLOCK_ID',
                    'ACTIVE',
                    'DETAIL_TEXT'
                ]
            ]);
            $arData = $rsElemData->fetch();
            if ($arData['IBLOCK_ID'] == \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult')) {
                if (
                    OnBeforeIBlockElementUpdate::$arRegister['consultRegisterActiveState'][$arFields['ID']]['ACTIVE'] == 'N'
                    && $arData['ACTIVE'] == 'Y'
                    && !empty(trim($arData['DETAIL_TEXT']))
                ) {
                    $rsElemData = \CIBlockElement::GetList([], ['ID' => $arFields['ID'], 'IBLOCK_ID' => $arData['IBLOCK_ID']], false, false, ['ID', 'IBLOCK_ID', 'PREVIEW_TEXT', 'PROPERTY_ASKER_NAME', 'PROPERTY_ASKER_EMAIL', 'DETAIL_PAGE_URL']);
                    $arData = $rsElemData->GetNext();

                    \Local\Core\TriggerMail\Consult::sendAnswerToUse([
                        'FIO' => $arData['PROPERTY_ASKER_NAME_VALUE'],
                        'EMAIL' => $arData['PROPERTY_ASKER_EMAIL_VALUE'],
                        'QUESTION' => ((new Format\FormatTrim(new Format\FormatStripTags()))->format($arData['PREVIEW_TEXT'])),
                        'ANSWER_LINK' => $arData['DETAIL_PAGE_URL']
                    ]);
                }
            }
        }
    }
}
