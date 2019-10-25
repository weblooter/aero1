<?php


namespace Local\Core\Assistant;

/**
 * Класс консультаций
 * Class Consult
 *
 * @package Local\Core\Assistant
 */
class Consult
{
    /**
     * Получить даныне по консультантам
     *
     * @param array $arConsultants
     *
     * @return mixed
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getConsultantsData(array $arConsultants)
    {
        $rsUser = \Bitrix\Main\UserTable::getList([
            'filter' => [
                'ID' => $arConsultants
            ],
            'select' => [
                'ID',
                'LAST_NAME',
                'NAME',
                'SECOND_NAME',
                'WORK_POSITION',
                'PERSONAL_PHOTO',
            ]
        ]);
        while ($ar = $rsUser->fetch()) {
            $arImage = \CFile::ResizeImageGet($ar['PERSONAL_PHOTO'], ['width' => 128, 'height' => 128], BX_RESIZE_IMAGE_EXACT, false, false, false, 75);
            $arResult['USER'][$ar['ID']] = [
                'FIO' => $ar['LAST_NAME'].' '.substr($ar['NAME'], 0, 1).'. '.substr($ar['SECOND_NAME'], 0, 1).'.',
                'IMG' => $arImage['src'],
                'WORK_POSITION' => $ar['WORK_POSITION']
            ];
        }

        return $arResult['USER'];
    }
}