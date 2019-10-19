<?php


namespace Local\Core\HighloadBlock;


class Entity
{
    const SettingsSocailnet = 'SettingsSocailnet';

    private static $instance = [];

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     *
     * @param $strName
     *
     * @return \Bitrix\Main\ORM\Data\DataManager
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getInstance($strName)
    {

        if (is_null(self::$instance[$strName])) {
            $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(['filter' => ['NAME' => $strName]])
                ->fetch();
            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
            self::$instance[$strName] = $entity->getDataClass();
        }

        return self::$instance[$strName];
    }
}