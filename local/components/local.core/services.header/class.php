<?

class ServicesHeaderComponent extends \Local\Core\Inner\BxModified\CBitrixComponent
{
    public function executeComponent()
    {
        $this->fillResult();
        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];

        $arResult['MENU'] = [
            'index' => [
                'NAME' => $this->arParams['DATA']['MAIN']['ELEMENT']['NAME'],
                'LINK' => $this->arParams['DATA']['MAIN']['ELEMENT']['DETAIL_PAGE_URL'],
                'PRE_H1' => 'Операция'
            ],
            'price' => [
                'NAME' => 'ЦЕНЫ',
                'LINK' => $this->arParams['DATA']['MAIN']['ELEMENT']['DETAIL_PAGE_URL'].'price/',
                'PRE_H1' => 'ЦЕНЫ'
            ],
            'action' => [
                'NAME' => 'АКЦИИ',
                'LINK' => $this->arParams['DATA']['MAIN']['ELEMENT']['DETAIL_PAGE_URL'].'action/',
                'PRE_H1' => 'АКЦИИ'
            ],
            'photo' => [
                'NAME' => 'ФОТО',
                'LINK' => $this->arParams['DATA']['MAIN']['ELEMENT']['DETAIL_PAGE_URL'].'photo/',
                'PRE_H1' => 'ФОТО ДО / ПОСЛЕ'
            ],
            'video' => [
                'NAME' => 'ВИДЕО',
                'LINK' => $this->arParams['DATA']['MAIN']['ELEMENT']['DETAIL_PAGE_URL'].'video/',
                'PRE_H1' => 'ВИДЕО'
            ],
            'review' => [
                'NAME' => 'ОТЗЫВЫ',
                'LINK' => $this->arParams['DATA']['MAIN']['ELEMENT']['DETAIL_PAGE_URL'].'review/',
                'PRE_H1' => 'ОТЗЫВЫ'
            ],
            'contacts' => [
                'NAME' => 'КЛИНИКА',
                'LINK' => $this->arParams['DATA']['MAIN']['ELEMENT']['DETAIL_PAGE_URL'].'contacts/',
                'PRE_H1' => 'КЛИНИКА'
            ],
            'consultation' => [
                'NAME' => 'КОНСУЛЬТАЦИЯ ОНЛАЙН',
                'LINK' => $this->arParams['DATA']['MAIN']['ELEMENT']['DETAIL_PAGE_URL'].'consultation/',
                'PRE_H1' => 'КОНСУЛЬТАЦИЯ ОНЛАЙН'
            ],
        ];

        $arResult['MENU'][$this->arParams['ACTIVE']]['ACTIVE'] = true;
        $arResult['MENU_ACTIVE'] = array_merge($arResult['MENU'][$this->arParams['ACTIVE']], $this->extractH1());
        $arResult['ACTIVE_TYPE'] = $this->arParams['ACTIVE'];

        $this->arResult = $arResult;
        unset($arResult);
    }

    /**
     * @return array
     */
    protected function extractH1()
    {
        $arH1 = [
            'H1' => $this->arParams['DATA']['MAIN']['ELEMENT']['PROPERTIES'][mb_strtoupper($this->arParams['ACTIVE']).'_H1']['VALUE'],
            'AFTER_H1' => $this->arParams['DATA']['MAIN']['ELEMENT']['PROPERTIES'][mb_strtoupper($this->arParams['ACTIVE']).'_AFTER_H1']['VALUE'],
        ];

        if( $this->arParams['ACTIVE'] === 'contacts' )
        {
            $arH1['AFTER_H1'] = tplvar('address');
        }

        return $arH1;
    }
}