<?

class ConsultShortFormComponent extends \CBitrixComponent
{
    public function executeComponent()
    {
        $this->fillResult();
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $this->arResult = [];
    }
}