<?php

namespace Local\Core\EventHandlers\Iblock;


class OnBeforeIBlockElementUpdate
{
    /** @var array $arRegister Регистр класса */
    public static $arRegister = [];

    /**
     * Регистрация состояния активности вопроса ИБ "консультация"
     *
     * @param $arFields
     *
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function consultRegisterActiveState(&$arFields)
    {
        if( $arFields['ID'] > 0 )
        {
            $rsElemData = \Bitrix\Iblock\ElementTable::getList([
                'filter' => [
                    'ID' => $arFields['ID']
                ],
                'select' => [
                    'ID',
                    'IBLOCK_ID',
                    'ACTIVE'
                ]
            ]);
            $arData = $rsElemData->fetch();
            if( $arData['IBLOCK_ID'] == \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult') )
            {
                self::$arRegister['consultRegisterActiveState'][$arFields['ID']]['ACTIVE'] = $arData['ACTIVE'];
            }
        }
    }
}
