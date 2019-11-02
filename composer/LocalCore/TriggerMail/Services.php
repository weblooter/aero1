<?php


namespace Local\Core\TriggerMail;


class Services
{
    /**
     * Обработчик формы с отзывом на детальной станице отзыва в услугах
     *
     * @param $arFields
     *
     * @return \Bitrix\Main\Entity\AddResult
     */
    public static function createReview($arFields)
    {
        return \Bitrix\Main\Mail\Event::send(array(
            "EVENT_NAME" => "LOCAL_CORE_SERVICES_CREATE_REVIEW",
            "LID" => "s1",
            "C_FIELDS" => array(
                'FIO' => $arFields['FIO'],
                'EMAIL' => $arFields['EMAIL'],
                'MSG' => $arFields['MSG'],
                'ELEM_ID' => $arFields['ELEM_ID'],
            )
        ));
    }
}