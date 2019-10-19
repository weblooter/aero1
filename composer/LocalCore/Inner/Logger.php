<?php


namespace Local\Core\Inner;

use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Logger
{

    protected static $instance = [];

    private function __construct()
    {
    }

    /**
     * @param string $strLoggerName
     *
     * @return \Monolog\Logger
     * @throws \Exception
     */
    public static function getInstance($strLoggerName = 'myLogger')
    {
        if (is_null(self::$instance[$strLoggerName])) {
            self::$instance[$strLoggerName] = new \Monolog\Logger($strLoggerName);

            self::$instance[$strLoggerName]->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'].'/logs/debug.log', \Monolog\Logger::DEBUG, false, 0776));
            self::$instance[$strLoggerName]->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'].'/logs/info.log', \Monolog\Logger::INFO, false, 0776));
            self::$instance[$strLoggerName]->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'].'/logs/notice.log', \Monolog\Logger::NOTICE, false, 0776));
            self::$instance[$strLoggerName]->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'].'/logs/warning.log', \Monolog\Logger::WARNING, false, 0776));
            self::$instance[$strLoggerName]->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'].'/logs/error.log', \Monolog\Logger::ERROR, false, 0776));
            self::$instance[$strLoggerName]->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'].'/logs/critical.log', \Monolog\Logger::CRITICAL, false, 0776));
            self::$instance[$strLoggerName]->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'].'/logs/alert.log', \Monolog\Logger::ALERT, false, 0776));
            self::$instance[$strLoggerName]->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'].'/logs/emergency.log', \Monolog\Logger::EMERGENCY, false, 0776));

            self::$instance[$strLoggerName]->pushHandler(new FirePHPHandler());
        }
        return self::$instance[$strLoggerName];
    }
}