<?php


namespace Local\Core\Register;


class ServicesComponent
{
    public static $title = null;

    /**
     * @return null
     */
    public static function getTitle()
    {
        return self::$title;
    }

    /**
     * @param null $title
     */
    public static function setTitle($title): void
    {
        self::$title = $title;
    }

    public static $description = null;

    /**
     * @return null
     */
    public static function getDescription()
    {
        return self::$description;
    }

    /**
     * @param null $description
     */
    public static function setDescription($description): void
    {
        self::$description = $description;
    }

    public static $keyword = null;

    /**
     * @return null
     */
    public static function getKeyword()
    {
        return self::$keyword;
    }

    /**
     * @param null $keyword
     */
    public static function setKeyword($keyword): void
    {
        self::$keyword = $keyword;
    }

    public static $h1 = null;

    /**
     * @return null
     */
    public static function getH1()
    {
        return self::$h1;
    }

    /**
     * @param null $h1
     */
    public static function setH1($h1): void
    {
        self::$h1 = $h1;
    }

    public static $afterH1 = null;

    /**
     * @return null
     */
    public static function getAfterH1()
    {
        return self::$afterH1;
    }

    /**
     * @param null $afterH1
     */
    public static function setAfterH1($afterH1): void
    {
        self::$afterH1 = $afterH1;
    }
}