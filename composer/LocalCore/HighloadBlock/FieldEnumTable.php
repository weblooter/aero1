<?php


namespace Local\Core\HighloadBlock;


/**
 *
 * Класс списка значений UF
 *
 * @package Local\Core\HighloadBlock
 */
class FieldEnumTable extends \Bitrix\Main\Entity\DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'b_user_field_enum';
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
            'USER_FIELD_ID' => array(
                'data_type' => 'integer',
            ),
            'VALUE' => array(
                'data_type' => 'string',
                'required' => true,
            ),
            'DEF' => array(
                'data_type' => 'boolean',
                'values' => array('N', 'Y'),
            ),
            'SORT' => array(
                'data_type' => 'integer',
            ),
            'XML_ID' => array(
                'data_type' => 'string',
                'required' => true,
            ),
        );
    }

    public static function update($primary, array $data)
    {
        throw new \Exception();
    }

    public static function add(array $data)
    {
        throw new \Exception();
    }

    public static function delete($primary)
    {
        throw new \Exception();
    }
}