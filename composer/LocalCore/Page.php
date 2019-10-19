<?php


namespace Local\Core;

use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;

/**
 * Класс настроек страницы
 *
 * @package Local\Core
 */
class Page
{
    protected static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __construct()
    {
    }


    /** @var $canonical string */
    protected $canonical = '';

    /**
     * @param string $canonical
     */
    public function setCanonical($canonical): void
    {
        $this->canonical = $canonical;
    }

    /**
     * @throws \Bitrix\Main\SystemException
     */
    public function footerInit(): void
    {

        if (is_null($this->canonical)) {
            $this->canonical = Application::getInstance()
                ->getContext()
                ->getRequest()
                ->getRequestUri();
        }

        Asset::getInstance()
            ->addString('<link rel="canonical" href="https://dr-vedrov.ru'.$this->canonical.'" />');

    }
}