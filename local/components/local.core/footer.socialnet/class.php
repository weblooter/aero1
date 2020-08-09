<?

use Bitrix\Main\Application;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Local\Core\HighloadBlock\Entity;
use Local\Core\HighloadBlock\FieldEnumTable;

class FooterSocialNetComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $this->fillResult();
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];

        $obCache = Application::getInstance()
            ->getCache();
        if ($obCache->startDataCache(60 * 60 * 12, __FILE__.__LINE__)) {
            try {
                $classSocial = Entity::getInstance(Entity::SettingsSocailnet);
                $rsSocial = $classSocial::getList(
                    [
                        'order' => ['UF_SORT' => 'ASC'],
                        'select' => [
                            '*',
                            'SOC_VALUE'
                        ],
                        'runtime' => [
                            (new Reference('SOC_VALUE', FieldEnumTable::class, Join::on('this.UF_SOC_TYPE', 'ref.ID')))
                        ]
                    ]
                );
                $arResult = [];
                while ($obSocial = $rsSocial->fetchObject()) {
                    $arResult[] = [
                        'CODE' => $obSocial->get('SOC_VALUE')
                            ->getXmlId(),
                        'LINK' => $obSocial->get('UF_LINK')
                    ];
                }

                $obCache->endDataCache($arResult);
            } catch (Throwable $e) {
                $obCache->abortDataCache();
            }
        } else {
            $arResult = $obCache->getVars();
        }

        $this->arResult = $arResult;
    }
}