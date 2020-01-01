<?php

namespace Sprint\Migration;


class Task_20190101_1_20200101182045 extends Version
{
    protected $description = "Добавляет св-во для вывода \"от\" в цены";

    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()
            ->getIblockIdIfExists('prices', 'main_ved');
        $helper->Iblock()
            ->saveProperty($iblockId, array(
                'NAME' => 'Выводить "от"',
                'ACTIVE' => 'Y',
                'SORT' => '300',
                'CODE' => 'PRINT_FROM',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'L',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'C',
                'MULTIPLE' => 'N',
                'XML_ID' => null,
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'N',
                'VERSION' => '1',
                'USER_TYPE' => null,
                'USER_TYPE_SETTINGS' => null,
                'HINT' => '',
                'VALUES' =>
                    array(
                        0 =>
                            array(
                                'VALUE' => 'Y',
                                'DEF' => 'N',
                                'SORT' => '500',
                                'XML_ID' => 'e9a5b3c834776a63b336c02d88093ed1',
                            ),
                    ),
            ));
        $helper->UserOptions()
            ->saveElementForm($iblockId, array(
                'Элемент' =>
                    array(
                        'ID' => 'ID',
                        'ACTIVE' => 'Активность',
                        'NAME' => 'Название',
                        'SORT' => 'Сортировка',
                        'PROPERTY_OPERATION' => 'Операция',
                        'PROPERTY_PRICE' => 'Стоимость',
                        'PROPERTY_PRINT_FROM' => 'Выводить "от"',
                        'PREVIEW_TEXT' => 'Описание для анонса',
                    ),
                'Разделы' =>
                    array(
                        'SECTIONS' => 'Разделы',
                    ),
            ));
        $helper->UserOptions()
            ->saveSectionForm($iblockId, array(
                'Раздел' =>
                    array(
                        'ID' => 'ID',
                        'NAME' => 'Название',
                        'SORT' => 'Сортировка',
                    ),
            ));

    }

    public function down()
    {
        //your code ...
    }
}