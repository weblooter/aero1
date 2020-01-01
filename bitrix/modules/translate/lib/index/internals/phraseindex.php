<?php

namespace Bitrix\Translate\Index\Internals;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Translate;
use Bitrix\Translate\Index;

/**
 * Class PhraseTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> FILE_ID int mandatory
 * <li> PATH_ID int mandatory
 * <li> LANG_ID string(2) mandatory
 * <li> CODE string(255) mandatory
 * <li> PHRASE string optional
 * </ul>
 *
 **/

class PhraseIndexTable extends DataManager
{
	use Index\Internals\BulkOperation;

	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'b_translate_phrase';
	}

	/**
	 * Returns class of Object for current entity.
	 *
	 * @return string
	 */
	public static function getObjectClass()
	{
		return Index\PhraseIndex::class;
	}

	/**
	 * Returns class of Object collection for current entity.
	 *
	 * @return string
	 */
	public static function getCollectionClass()
	{
		return Index\PhraseIndexCollection::class;
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
			'FILE_ID' => array(
				'data_type' => 'integer',
			),
			'PATH_ID' => array(
				'data_type' => 'string',
			),
			'LANG_ID' => array(
				'data_type' => 'string',
			),
			'CODE' => array(
				'data_type' => 'string',
			),
			'PHRASE' => array(
				'data_type' => 'string',
			),
			'FILE' => array(
				'data_type' => '\Bitrix\Translate\Index\Internals\FileIndexTable',
				'reference' => array(
					'=this.FILE_ID' => 'ref.ID',
				),
				'join_type' => 'INNER',
			),
			'PATH' => array(
				'data_type' => '\Bitrix\Translate\Index\Internals\PathIndexTable',
				'reference' => array(
					'=this.PATH_ID' => 'ref.ID',
				),
				'join_type' => 'INNER',
			),
		);
	}

	/**
	 * Drop index.
	 *
	 * @param Translate\Filter $filter Params to filter file list.
	 *
	 * @return void
	 */
	public static function purge(Translate\Filter $filter = null)
	{
		if (($filterOut = static::processFilter($filter)) !== false)
		{
			static::bulkDelete($filterOut);
		}
	}

	/**
	 * Processes filter params to convert them into orm type.
	 *
	 * @param Translate\Filter $filter Params to filter file list.
	 *
	 * @return array|bool
	 */
	public static function processFilter(Translate\Filter $filter = null)
	{
		$filterOut = array();

		foreach ($filter as $key => $value)
		{
			if (empty($value))
			{
				continue;
			}

			if ($key === 'path')
			{
				$filterOut['=%PATH.PATH'] = $value . '%';
			}
			elseif ($key === 'fileId')
			{
				$filterOut['=FILE_ID'] = $value;
			}
			elseif ($key === 'pathId')
			{
				$filterOut['=PATH_ID'] = $value;
			}
			elseif ($key === 'langId')
			{
				$filterOut['=LANG_ID'] = $value;
			}
			elseif ($key === 'indexedTime')
			{
				$filterOut['<FILE.INDEXED_TIME'] = $value;
			}
			else
			{
				if (static::getEntity()->hasField(trim($key,'<>!=@~%*')))
				{
					$filterOut[$key] = $value;
				}
			}
		}

		return $filterOut;
	}
}
