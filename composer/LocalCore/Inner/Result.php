<?php


namespace Local\Core\Inner;


/**
 *
 * Расширенный класс \Bitrix\Main\Result c Warnings.
 *
 * @package Local\Core\Inner
 */
class Result extends \Bitrix\Main\Result
{
    /** @var bool */
    protected $isWarning = false;
    /** @var \Bitrix\Main\ErrorCollection */
    protected $warnings;

    public function __construct()
    {
        $this->warnings = new \Bitrix\Main\ErrorCollection();
        parent::__construct();
    }

    /**
     * @return bool
     */
    public function isWarning()
    {
        return $this->isWarning;
    }

    /**
     * @param \Bitrix\Main\Error $warning
     *
     * @return $this
     */
    public function addWarning(\Bitrix\Main\Error $warning)
    {
        $this->isWarning = true;
        $this->warnings[] = $warning;
        return $this;
    }

    /**
     * Adds array of Error objects
     *
     * @param \Bitrix\Main\Error[] $warnings
     *
     * @return $this
     */
    public function addWarnings(array $warnings)
    {
        $this->isWarning = true;
        $this->warnings->add($warnings);
        return $this;
    }

    /**
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings->toArray();
    }

    /**
     * @return \Bitrix\Main\ErrorCollection
     */
    public function getWarningCollection()
    {
        return $this->warnings;
    }

    /**
     * @return array
     */
    public function getWarningMessages()
    {
        $messages = array();

        foreach ($this->getWarnings() as $error) {
            $messages[] = $error->getMessage();
        }

        return $messages;
    }
}