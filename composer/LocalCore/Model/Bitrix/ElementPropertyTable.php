<?php


namespace Local\Core\Model\Bitrix;

/**
 * Class ElementPropertyTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> IBLOCK_PROPERTY_ID int mandatory
 * <li> IBLOCK_ELEMENT_ID int mandatory
 * <li> VALUE string mandatory
 * <li> VALUE_TYPE enum ('text', 'html') optional default 'text'
 * <li> VALUE_ENUM int optional
 * <li> VALUE_NUM double optional
 * <li> DESCRIPTION string(255) optional
 * <li> IBLOCK_ELEMENT reference to {@link \Bitrix\Iblock\IblockElementTable}
 * <li> IBLOCK_PROPERTY reference to {@link \Bitrix\Iblock\IblockPropertyTable}
 * </ul>
 *
 * @package Bitrix\Iblock
 **/
class ElementPropertyTable extends \Bitrix\Main\Entity\DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'b_iblock_element_property';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
            ),
            'IBLOCK_PROPERTY_ID' => array(
                'data_type' => 'integer',
                'required' => true,
            ),
            'IBLOCK_ELEMENT_ID' => array(
                'data_type' => 'integer',
                'required' => true,
            ),
            'VALUE' => array(
                'data_type' => 'text',
                'required' => true,
            ),
            'VALUE_TYPE' => array(
                'data_type' => 'enum',
                'values' => array('text', 'html'),
            ),
            'VALUE_ENUM' => array(
                'data_type' => 'integer',
            ),
            'VALUE_NUM' => array(
                'data_type' => 'float',
            ),
            'DESCRIPTION' => array(
                'data_type' => 'string',
            ),
        );
    }

    public static function add()
    {
        die();
    }

    public static function update()
    {
        die();
    }

    public static function delete()
    {
        die();
    }
}