<?php


namespace Local\Core\TriggerMail;


class Consult
{
    /**
     * Обработчик формы "Задать вопрос онлайн" на всех страницах сайта внизу
     *
     * @param $arFields
     *
     * @return \Bitrix\Main\Entity\AddResult
     */
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

    /**
     * Обработчик формы "Задать вопрос" на страницах консультации
     *
     * @param $arFields
     *
     * @return \Bitrix\Main\Entity\AddResult
     */
    public static function createAnswer($arFields)
    {
        return \Bitrix\Main\Mail\Event::send(array(
            "EVENT_NAME" => "LOCAL_CORE_CONSULT_SEND_ANSWER",
            "LID" => "s1",
            "C_FIELDS" => array(
                'FIO' => $arFields['FIO'],
                'EMAIL' => $arFields['EMAIL'],
                'MSG' => $arFields['MSG'],
                'ELEM_ID' => $arFields['ELEM_ID'],
            )
        ));
    }

    /**
     * Обработчик ответа на вопрос в ИБ "Консультация"
     *
     * @param $arFields
     *
     * @return \Bitrix\Main\Entity\AddResult
     */
    public static function sendAnswerToUse($arFields)
    {
        return \Bitrix\Main\Mail\Event::send(array(
            "EVENT_NAME" => "LOCAL_CORE_CONSULT_SEND_USER_ANSWER",
            "LID" => "s1",
            "C_FIELDS" => array(
                'FIO' => $arFields['FIO'],
                'EMAIL' => $arFields['EMAIL'],
                'QUESTION' => $arFields['QUESTION'],
                'ANSWER_LINK' => $arFields['ANSWER_LINK'],
            )
        ));
    }
}