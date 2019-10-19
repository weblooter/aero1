<?php


namespace Local\Core\TriggerMail;


class Consult
{
    public static function shortForm($arFields)
    {
        return \Bitrix\Main\Mail\Event::send(array(
            "EVENT_NAME" => "LOCAL_CORE_CONSULT_SHORT_FORM",
            "LID" => "s1",
            "C_FIELDS" => array(
                'MSG' => $arFields['MSG'],
            )
        ));
    }

}