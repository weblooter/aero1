<?php

namespace Sprint\Migration;


class Version20200227213647 extends Version
{
    protected $description = "";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('prices', 'main_ved');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Текст скидки',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DISCOUNT_TITLE',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->UserOptions()->saveElementForm($iblockId, array (
  'Элемент' => 
  array (
    'ID' => 'ID',
    'ACTIVE' => 'Активность',
    'NAME' => 'Название',
    'SORT' => 'Сортировка',
    'PROPERTY_OPERATION' => 'Операция',
    'PROPERTY_PRICE' => 'Стоимость',
    'PROPERTY_DISCOUNT' => 'Размер скидки (целое число)',
    'PROPERTY_DISCOUNT_TITLE' => 'Текст скидки',
    'PROPERTY_PRINT_FROM' => 'Выводить "от"',
    'PREVIEW_TEXT' => 'Описание для анонса',
  ),
  'Разделы' => 
  array (
    'SECTIONS' => 'Разделы',
  ),
));
        $helper->UserOptions()->saveSectionForm($iblockId, array (
  'Раздел' => 
  array (
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