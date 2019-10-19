<?

class FooterSocialNetComponent extends \CBitrixComponent
{
    public function executeComponent()
    {
        $this->fillResult();
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];

        $obCache = \Bitrix\Main\Application::getInstance()
            ->getCache();
        if ($obCache->startDataCache(60 * 60 * 12, __FILE__.__LINE__)) {

            try {
                $classSocial = \Local\Core\HighloadBlock\Entity::getInstance(\Local\Core\HighloadBlock\Entity::SettingsSocailnet);
                $rsSocial = $classSocial::getList([
                    'order' => ['UF_SORT' => 'ASC'],
                    'select' => [
                        '*',
                        'SOC_VALUE'
                    ],
                    'runtime' => [
                        (new \Bitrix\Main\ORM\Fields\Relations\Reference('SOC_VALUE', \Local\Core\HighloadBlock\FieldEnumTable::class, \Bitrix\Main\ORM\Query\Join::on('this.UF_SOC_TYPE', 'ref.ID')))
                    ]
                ]);
                $arResult = [];
                while ($obSocial = $rsSocial->fetchObject()) {
                    $arResult[] = [
                        'CODE' => $obSocial->get('SOC_VALUE')
                            ->getXmlId(),
                        'LINK' => $obSocial->get('UF_LINK')
                    ];
                }

                $obCache->endDataCache($arResult);
            } catch (\Throwable $e) {
                $obCache->abortDataCache();
            }
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
    }
}