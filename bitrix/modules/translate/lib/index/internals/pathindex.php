<?php

namespace Bitrix\Translate\Index\Internals;

use Bitrix\Main;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Translate;
use Bitrix\Translate\Index;

/**
 * Class PathTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> PARENT_ID int
 * <li> PATH string(255)
 * <li> NAME string(255)
 * <li> MODULE_ID string(50) optional
 * <li> ASSIGNMENT string(50) optional
 * <li> LEFT_MARGIN int optional
 * <li> RIGHT_MARGIN int optional
 * <li> DEPTH_LEVEL int optional
 * <li> SORT int optional
 * <li> IS_LANG bool optional
 * <li> IS_DIR bool optional
 * <li> INDEXED bool optional
 * <li> INDEXED_TIME datetime default 'CURRENT_TIMESTAMP'
 * <li> HAS_SETTINGS bool optional
 * </ul>
 *
 **/

class PathIndexTable extends DataManager
{
	use Index\Internals\BulkOperation;

	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'b_translate_path';
	}

	/**
	 * Returns class of Object for current entity.
	 *
	 * @return string
	 */
	public static function getObjectClass()
	{
		return Index\PathIndex::class;
	}

	/**
	 * Returns class of Object collection for current entity.
	 *
	 * @return string
	 */
	public static function getCollectionClass()
	{
		return Index\PathIndexCollection::class;
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
			'PARENT_ID' => array(
				'data_type' => 'integer',
			),
			'PATH' => array(
				'data_type' => 'string',
			),
			'NAME' => array(
				'data_type' => 'string',
			),
			'MODULE_ID' => array(
				'data_type' => 'string',
			),
			'ASSIGNMENT' => array(
				'data_type' => 'enum',
				'values' => Translate\ASSIGNMENT_TYPES,
			),
			'DEPTH_LEVEL' => array(
				'data_type' => 'integer',
				'default_value' => 0,
			),
			'SORT' => array(
				'data_type' => 'integer',
				'default_value' => 0,
			),
			'LEFT_MARGIN' => array(
				'data_type' => 'integer',
			),
			'RIGHT_MARGIN' => array(
				'data_type' => 'integer',
			),
			'IS_LANG' => array(
				'data_type' => 'boolean',
				'values' => array('N', 'Y'),
				'default_value' => 'N',
			),
			'IS_DIR' => array(
				'data_type' => 'boolean',
				'values' => array('N', 'Y'),
				'default_value' => 'N',
			),
			'OBLIGATORY_LANGS' => array(
				'data_type' => 'string',
			),
			'INDEXED' => array(
				'data_type' => 'boolean',
				'values' => array('N', 'Y'),
				'default_value' => 'N',
			),
			'INDEXED_TIME' => array(
				'data_type' => 'datetime',
			),
			'FILE' => array(
				'data_type' => '\Bitrix\Translate\Index\Internals\FileIndexTable',
				'reference' => array(
					'=this.ID' => 'ref.PATH_ID'
				),
				'join_type' => 'LEFT',
			),
			'TOP' => array(
				'data_type' => '\Bitrix\Translate\Index\Internals\PathIndexTable',
				'reference' => array(
					'>=this.LEFT_MARGIN' => 'ref.LEFT_MARGIN',
					'<=this.RIGHT_MARGIN' => 'ref.RIGHT_MARGIN',
				),
				'join_type' => 'INNER',
			),
		);
	}

	/**
	 * Rearrange a branch of the nested set before insert new node.
	 *
	 * @param int $parentId Parent node.
	 *
	 * @return int $newLeftMargin Starting right border.
	 * @throws Main\Db\SqlQueryException
	 */
	public static function beforeInsertNode($parentId)
	{
		$tableName = static::getTableName();
		$connection = Main\Application::getConnection();
		$newLeftMargin = 0;

		$res = $connection->query("SELECT RIGHT_MARGIN FROM {$tableName} WHERE ID = ".(int)$parentId);
		if ($row = $res->fetch())
		{
			$newLeftMargin = (int)$row['RIGHT_MARGIN'];

			$connection->queryExecute("
				UPDATE {$tableName}
				SET
					RIGHT_MARGIN = RIGHT_MARGIN + 2,
					LEFT_MARGIN = (
						case
							when LEFT_MARGIN > {$newLeftMargin} then LEFT_MARGIN + 2
							else LEFT_MARGIN
						end
					)
				WHERE
					RIGHT_MARGIN >= {$newLeftMargin}
			");
		}

		return $newLeftMargin;
	}

	/**
	 * Rearrange a branch of the nested set after delete node.
	 *
	 * @param int $leftMargin Node left border.
	 * @param int $rightMargin Node right border.
	 *
	 * @return void
	 * @throws Main\Db\SqlQueryException
	 */
	public static function afterDeleteNode($leftMargin, $rightMargin)
	{
		$tableName = static::getTableName();
		$connection = Main\Application::getConnection();

		// UPDATE tree SET
		// 	right_key = right_key – ($right_key - $left_key + 1)
		// 	left_key = IF(left_key > $left_key, left_key – ($right_key - $left_key + 1), left_key),
		// WHERE right_key > $right_key
		$connection->queryExecute("
			UPDATE {$tableName}
			SET
				RIGHT_MARGIN = RIGHT_MARGIN - ({$rightMargin} - {$leftMargin} + 1),
				LEFT_MARGIN = (
					case
						when LEFT_MARGIN > {$leftMargin} then LEFT_MARGIN - ({$rightMargin} - {$leftMargin} + 1)
						else LEFT_MARGIN
					end
				)
			WHERE
				RIGHT_MARGIN > {$rightMargin}
		");
	}

	/**
	 * Rearrange tree as nested set structure.
	 *
	 * @param int $id Top level node id.
	 * @param int $cnt Nested set border value.
	 * @param int $depth Depth level node position.
	 *
	 * @return int
	 * @throws Main\Db\SqlQueryException
	 */
	public static function arrangeTree($id, $cnt = 0, $depth = 0)
	{
		if ((int)$id <= 0)
		{
			throw new Main\ArgumentException();
		}

		static $tableName;
		if (empty($tableName))
		{
			$tableName = static::getTableName();
		}
		static $connection;
		if (empty($connection))
		{
			$connection = Main\Application::getConnection();
		}

		$connection->queryExecute("
			UPDATE {$tableName}
			SET
				RIGHT_MARGIN = ".(int)$cnt.",
				LEFT_MARGIN = ".(int)$cnt.",
				DEPTH_LEVEL = ".(int)$depth."
			WHERE
				ID = ".(int)$id
		);

		$query = "
			SELECT ID
			FROM {$tableName} 
			WHERE 
				PARENT_ID = ".(int)$id."
			ORDER BY NAME
		";

		$cnt++;
		$res = $connection->query($query);
		while ($arr = $res->fetch())
		{
			$cnt = static::arrangeTree($arr['ID'], $cnt, $depth + 1);
		}

		if ($id > 0)
		{
			$connection->queryExecute("
				UPDATE {$tableName}
				SET
					RIGHT_MARGIN = ".(int)$cnt.",
					DEPTH_LEVEL = ".(int)$depth."
				WHERE
					ID = ".(int)$id
			);
		}

		return $cnt + 1;
	}

	/**
	 * Performs index clearing from non lang path.
	 *
	 * @param array $filter Filter looks like filter in getList.
	 *
	 * @return void
	 * @throws Main\Db\SqlQueryException
	 */
	public static function removeNonLang(array $filter = [])
	{
		$tableName = static::getTableName();
		$connection = Main\Application::getConnection();
		do
		{
			$doneSmth = false;

			$maxDepthLevel = 0;
			$res0 = $connection->query("SELECT MAX(DEPTH_LEVEL) + 1 as DEPTH_LEVEL FROM {$tableName}");
			if ($arr0 = $res0->fetch())
			{
				$maxDepthLevel = $arr0['DEPTH_LEVEL'];
			}
			// The maximum number of tables that can be referenced in a single join
			if ($maxDepthLevel > 61)
			{
				$maxDepthLevel = 61;
			}

			$from = $select = $where = $whereFilter = '';
			for ($t = 1; $t < $maxDepthLevel; $t++)
			{
				$t1 = 'p'.$t;
				$t2 = 'p'.($t + 1);
				$select .= " WHEN {$t2}.IS_LANG IS NULL AND {$t1}.IS_LANG = 'N' then {$t1}.ID \n";
				$from .= " LEFT JOIN {$tableName} {$t2} ON {$t1}.ID = {$t2}.PARENT_ID \n";
				$where .= " OR {$t2}.IS_LANG IS NULL AND {$t1}.IS_LANG = 'N' \n";
			}

			if (!empty($filter))
			{
				$whereFilter = static::prepareWhere(
					$filter,
					array(
						'LEFT_MARGIN' => 'p1.LEFT_MARGIN',
						'RIGHT_MARGIN' => 'p1.RIGHT_MARGIN',
					)
				);
			}

			$query = "
				SELECT 
					CASE  
						WHEN p{$maxDepthLevel}.IS_LANG = 'N' THEN p{$maxDepthLevel}.ID 
						{$select}
					END as ID
				FROM
					{$tableName} p1
					{$from}
				WHERE
					( p{$maxDepthLevel}.IS_LANG = 'N' {$where} )
					{$whereFilter}
			";
			$res = $connection->query($query);
			while ($arr = $res->fetch())
			{
				if ($arr['ID'] > 0)
				{
					$doneSmth = true;
					$connection->queryExecute("DELETE FROM {$tableName} WHERE ID = ".(int)$arr['ID']);
				}
			}
		}
		while ($doneSmth === true);
	}


	/**
	 * Drop index.
	 *
	 * @param Translate\Filter $filter Params to filter file list.
	 * @param bool $recursively Drop index recursively.
	 *
	 * @return void
	 */
	public static function purge(Translate\Filter $filter = null, $recursively = true)
	{
		if (($filterOut = static::processFilter($filter)) !== false)
		{
			if ($recursively)
			{
				Index\Internals\FileIndexTable::purge($filter);
			}

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
				$filterOut['=%PATH'] = $value . '%';
			}
			elseif ($key === 'pathId')
			{
				$filterOut['=ID'] = $value;
			}
			elseif ($key === 'indexedTime')
			{
				$filterOut['<INDEXED_TIME'] = $value;
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
