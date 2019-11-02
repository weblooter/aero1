<?

class EmptyComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{
    public function executeComponent()
    {
        if ($this->startResultCache(60 * 60 * 24 * 7)) {
            $this->fillResult();
            $this->endResultCache();
        }
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];
        try {

        } catch (\Exception $e) {
            $this->abortResultCache();
        }
        $this->arResult = $arResult;
    }
}