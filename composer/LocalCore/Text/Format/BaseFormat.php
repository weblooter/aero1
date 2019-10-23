<?php


namespace Local\Core\Text\Format;


class BaseFormat
{
    protected $obInputClass;
    public function __construct(BaseFormat $obInputClass = null)
    {
        $this->obInputClass = $obInputClass;
    }

    /**
     * Форматирование
     *
     * @param $strText
     *
     * @return string
     */
    public function format($strText)
    {
        if( $this->obInputClass instanceof BaseFormat)
        {
            return $this->obInputClass->format($strText);
        }
        else
        {
            return $strText;
        }
    }
}