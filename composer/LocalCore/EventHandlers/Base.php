<?php

namespace Local\Core\EventHandlers;

use Bitrix\Main\EventManager;

class Base
{
    /**
     * Регистрирует все обработчики событий
     */
    public static function register()
    {
        self::registerMain();
        self::registerIblock();
    }

    /**
     * Рестрирует все обработчики событий для модуля main
     */
    private static function registerMain()
    {
        $eventManager = EventManager::getInstance();

        /** @see \Local\Core\EventHandlers\Main\OnBeforeEventSend::executeCondition() */
        $eventManager->addEventHandler('main', 'OnBeforeEventSend', [Main\OnBeforeEventSend::class, 'executeCondition']);

    }

    /**
     * Рестрирует все обработчики событий для модуля iblock
     */
    private static function registerIblock()
    {
        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            $eventManager = EventManager::getInstance();


            /**
             * Группа обработчиков, отвечающая за отправку сообщения с ответом
             * из ИБ "Консультации" в случае, если был дан ответ и произошла активация елемента.
             */

            /** @see \Local\Core\EventHandlers\Iblock\OnBeforeIBlockElementUpdate::consultRegisterActiveState(); */
            $eventManager->addEventHandler('iblock', 'OnBeforeIBlockElementUpdate', [
                Iblock\OnBeforeIBlockElementUpdate::class,
                'consultRegisterActiveState'
            ]);
            /** @see \Local\Core\EventHandlers\Iblock\OnAfterIBlockElementUpdate::consultRegisterActiveState(); */
            $eventManager->addEventHandler('iblock', 'OnAfterIBlockElementUpdate', [
                Iblock\OnAfterIBlockElementUpdate::class,
                'consultRegisterActiveState'
            ]);
        }
    }
}
