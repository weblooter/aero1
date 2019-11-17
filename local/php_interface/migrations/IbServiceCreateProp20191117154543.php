<?php

namespace Sprint\Migration;


class IbServiceCreateProp20191117154543 extends Version
{
    protected $description = "";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('services', 'main_ved');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Выводить на главной',
  'ACTIVE' => 'Y',
  'SORT' => '100',
  'CODE' => 'SHOW_ON_INDEX',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'C',
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
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Y',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '0390870e4b5671ae3560503ab639c1c9',
    ),
  ),
));
        $helper->UserOptions()->saveElementForm($iblockId, array (
  'Элемент' => 
  array (
    'ID' => 'ID',
    'ACTIVE' => 'Активность',
    'NAME' => 'Название',
    'CODE' => 'Символьный код',
    'SORT' => 'Сортировка',
    'PROPERTY_SHOW_ON_INDEX' => 'Выводить на главной',
    'PREVIEW_PICTURE' => 'Картинка для анонса',
    'PREVIEW_TEXT' => 'Описание для анонса',
  ),
  'Об операции' => 
  array (
    'PROPERTY_INDEX_H1' => 'Seo: H1',
    'PROPERTY_INDEX_AFTER_H1' => 'Seo: Строка после H1',
    'PROPERTY_INDEX_TITLE' => 'Seo: Title',
    'PROPERTY_INDEX_DESCRIPTION' => 'Seo: Description',
    'PROPERTY_INDEX_KEYWORDS' => 'Seo: Keywords',
    'PROPERTY_INDEX_FIRST_BLOCK' => 'Первый блок',
    'PROPERTY_INDEX_OPETAION_PROPS' => 'Параметры операции: Выводимые параметы',
    'PROPERTY_INDEX_OPETAION_PROPS_VAL' => 'Параметры операции: Значения',
    'PROPERTY_INDEX_PHOTOS_BEFORE_AFTER' => 'Фото до и после',
    'PROPERTY_INDEX_SECOND_BLOCK' => 'Второй блок',
  ),
  'Цены' => 
  array (
    'PROPERTY_PRICE_H1' => 'Seo: H1',
    'PROPERTY_PRICE_AFTER_H1' => 'Seo: Строка после H1',
    'PROPERTY_PRICE_TITLE' => 'Seo: Title',
    'PROPERTY_PRICE_DESCRIPTION' => 'Seo: Description',
    'PROPERTY_PRICE_KEYWORDS' => 'Seo: Keywords',
    'PROPERTY_PRICE_FIRST_BLOCK' => 'Первый блок',
    'PROPERTY_PRICE_PRICES' => 'Цены',
    'PROPERTY_PRICE_SECOND_BLOCK' => 'Второй блок',
  ),
  'Акции' => 
  array (
    'PROPERTY_ACTION_H1' => 'Seo: H1',
    'PROPERTY_ACTION_AFTER_H1' => 'Seo: Строка после H1',
    'PROPERTY_ACTION_TITLE' => 'Seo: Title',
    'PROPERTY_ACTION_DESCRIPTION' => 'Seo: Description',
    'PROPERTY_ACTION_KEYWORDS' => 'Seo: Keywords',
    'PROPERTY_ACTION_FIRST_BLOCK' => 'Первый блок',
    'PROPERTY_ACTION_ACTIONS' => 'Акции',
    'PROPERTY_ACTION_SECOND_BLOCK' => 'Второй блок',
  ),
  'Фото работ' => 
  array (
    'PROPERTY_PHOTO_H1' => 'Seo: H1',
    'PROPERTY_PHOTO_AFTER_H1' => 'Seo: Строка после H1',
    'PROPERTY_PHOTO_TITLE' => 'Seo: Title',
    'PROPERTY_PHOTO_DESCRIPTION' => 'Seo: Description',
    'PROPERTY_PHOTO_KEYWORDS' => 'Seo: Keywords',
    'PROPERTY_PHOTO_FIRST_BLOCK' => 'Первый блок',
    'PROPERTY_PHOTO_PHOTOS' => 'Фото работ',
    'PROPERTY_PHOTO_SECOND_BLOCK' => 'Второй блок',
  ),
  'Видео' => 
  array (
    'PROPERTY_VIDEO_H1' => 'Seo: H1',
    'PROPERTY_VIDEO_AFTER_H1' => 'Seo: Строка после H1',
    'PROPERTY_VIDEO_TITLE' => 'Seo: Title',
    'PROPERTY_VIDEO_DESCRIPTION' => 'Seo: Description',
    'PROPERTY_VIDEO_KEYWORDS' => 'Seo: Keywords',
    'PROPERTY_VIDEO_FIRST_BLOCK' => 'Первый блок',
    'PROPERTY_VIDEO_VIDEOS' => 'Видео',
    'PROPERTY_VIDEO_SECOND_BLOCK' => 'Второй блок',
  ),
  'Отзывы' => 
  array (
    'PROPERTY_REVIEW_H1' => 'Seo: H1',
    'PROPERTY_REVIEW_AFTER_H1' => 'Seo: Строка после H1',
    'PROPERTY_REVIEW_TITLE' => 'Seo: Title',
    'PROPERTY_REVIEW_DESCRIPTION' => 'Seo: Description',
    'PROPERTY_REVIEW_KEYWORDS' => 'Seo: Keywords',
    'PROPERTY_REVIEW_FIRST_BLOCK' => 'Первый блок',
    'PROPERTY_REVIEW_REVIEWS' => 'Отзывы',
    'PROPERTY_REVIEW_SECOND_BLOCK' => 'Второй блок',
  ),
  'Контакты' => 
  array (
    'PROPERTY_CONTACTS_H1' => 'Seo: H1',
    'PROPERTY_CONTACTS_TITLE' => 'Seo: Title',
    'PROPERTY_CONTACTS_DESCRIPTION' => 'Seo: Description',
    'PROPERTY_CONTACTS_KEYWORDS' => 'Seo: Keywords',
    'PROPERTY_CONTACTS_FB_TITLE' => 'Блок аннотации - заголовок',
    'PROPERTY_CONTACTS_FB_HEADER' => 'Блок аннотации - h2',
    'PROPERTY_CONTACTS_PHOTOS' => 'Фото',
    'PROPERTY_CONTACTS_SECOND_BLOCK' => 'Второй блок',
  ),
  'Консультация' => 
  array (
    'PROPERTY_CONSULTATION_H1' => 'Seo: H1',
    'PROPERTY_CONSULTATION_AFTER_H1' => 'Seo: Строка после H1',
    'PROPERTY_CONSULTATION_TITLE' => 'Seo: Title',
    'PROPERTY_CONSULTATION_DESCRIPTION' => 'Seo: Description',
    'PROPERTY_CONSULTATION_KEYWORDS' => 'Seo: Keywords',
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
    'ACTIVE' => 'Раздел активен',
    'NAME' => 'Название',
    'CODE' => 'Символьный код',
    'SORT' => 'Сортировка',
    'UF_MAIN_NAME' => 'Название на главной станице',
    'UF_MAIN_IMG' => 'Картинка для главной',
  ),
  'SEO' => 
  array (
    'IPROPERTY_TEMPLATES_SECTION' => 'Настройки для разделов',
    'IPROPERTY_TEMPLATES_SECTION_META_TITLE' => 'Шаблон META TITLE',
    'IPROPERTY_TEMPLATES_SECTION_META_KEYWORDS' => 'Шаблон META KEYWORDS',
    'IPROPERTY_TEMPLATES_SECTION_META_DESCRIPTION' => 'Шаблон META DESCRIPTION',
    'IPROPERTY_TEMPLATES_SECTION_PAGE_TITLE' => 'Заголовок раздела',
    'IPROPERTY_TEMPLATES_ELEMENT' => 'Настройки для элементов',
    'IPROPERTY_TEMPLATES_ELEMENT_META_TITLE' => 'Шаблон META TITLE',
    'IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS' => 'Шаблон META KEYWORDS',
    'IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION' => 'Шаблон META DESCRIPTION',
    'IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE' => 'Заголовок товара',
    'IPROPERTY_TEMPLATES_SECTIONS_PICTURE' => 'Настройки для изображений разделов',
    'IPROPERTY_TEMPLATES_SECTION_PICTURE_FILE_ALT' => 'Шаблон ALT',
    'IPROPERTY_TEMPLATES_SECTION_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
    'IPROPERTY_TEMPLATES_SECTION_PICTURE_FILE_NAME' => 'Шаблон имени файла',
    'IPROPERTY_TEMPLATES_SECTIONS_DETAIL_PICTURE' => 'Настройки для детальных картинок разделов',
    'IPROPERTY_TEMPLATES_SECTION_DETAIL_PICTURE_FILE_ALT' => 'Шаблон ALT',
    'IPROPERTY_TEMPLATES_SECTION_DETAIL_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
    'IPROPERTY_TEMPLATES_SECTION_DETAIL_PICTURE_FILE_NAME' => 'Шаблон имени файла',
    'IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE' => 'Настройки для картинок анонса элементов',
    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT' => 'Шаблон ALT',
    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME' => 'Шаблон имени файла',
    'IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE' => 'Настройки для детальных картинок элементов',
    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT' => 'Шаблон ALT',
    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME' => 'Шаблон имени файла',
    'IPROPERTY_TEMPLATES_MANAGEMENT' => 'Управление',
    'IPROPERTY_CLEAR_VALUES' => 'Очистить кеш вычисленных значений',
  ),
));
    $helper->UserOptions()->saveElementGrid($iblockId, array (
  'views' => 
  array (
    'default' => 
    array (
      'columns' => '',
      'columns_sizes' => 
      array (
        'expand' => 1,
        'columns' => 
        array (
        ),
      ),
      'sticked_columns' => 
      array (
      ),
    ),
  ),
  'filters' => 
  array (
  ),
  'current_view' => 'default',
));
    $helper->UserOptions()->saveSectionGrid($iblockId, array (
  'views' => 
  array (
    'default' => 
    array (
      'columns' => '',
      'columns_sizes' => 
      array (
        'expand' => 1,
        'columns' => 
        array (
        ),
      ),
      'sticked_columns' => 
      array (
      ),
      'last_sort_by' => 'sort',
      'last_sort_order' => 'asc',
    ),
  ),
  'filters' => 
  array (
  ),
  'current_view' => 'default',
));

    }

    public function down()
    {
        //your code ...
    }
}