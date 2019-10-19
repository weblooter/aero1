<?php

namespace Local\Core\Inner\BxModified;


class HttpResponse extends \Bitrix\Main\HttpResponse
{
    const RESPONSE_SUCCESS = 'success';
    const RESPONSE_WARNING = 'warning';
    const RESPONSE_ERROR = 'error';

    /**
     * Создает ответ в формате JSON
     *
     * @param     $data
     * @param int $status
     *
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Bitrix\Main\ArgumentOutOfRangeException
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public function setContentJson($data, $status = 200)
    {
        $json = \Bitrix\Main\Web\Json::encode($data, JSON_UNESCAPED_UNICODE);

        $this->setContent($json);

        if ($json === false) {
            throw new \RuntimeException(\json_last_error_msg(), \json_last_error());
        }

        $this->setHeader('Content-Type: application/json;charset=utf-8');

        $this->setStatus($status);

    }

    /**
     * Формирует успешный ответ
     *
     * @param array $arData
     * @param int   $status
     */
    public function setSuccessAjaxResult(array $arData, $status = 200)
    {
        $this->setContentJson(
            [
                'status' => static::RESPONSE_SUCCESS,
                'data' => $arData
            ], $status
        );
    }

    /**
     * Формирует успешный ответ с предупреждением
     *
     * @param array $arData
     * @param array $arWarnings
     * @param int   $status
     */
    public function setWarningAjaxResult(array $arData, array $arWarnings, $status = 200)
    {
        $this->setContentJson(
            [
                'status' => static::RESPONSE_WARNING,
                'warnings' => $arWarnings,
                'data' => $arData
            ], $status
        );
    }

    /**
     * Формирует ответ с ошибками
     *
     * @param array $arData
     * @param array $arErrors
     * @param int   $status
     */
    public function setErrorAjaxResult(array $arData, array $arErrors, $status = 200)
    {
        $this->setContentJson(
            [
                'status' => static::RESPONSE_ERROR,
                'errors' => $arErrors,
                'data' => $arData
            ], $status
        );
    }

    public function setHeader($str){
        $ar = explode(':', $str, 1);
        return $this->addHeader($ar[0], $ar[1]);
    }

}