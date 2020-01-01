<?php

namespace Bitrix\Translate\Index;

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Translate;
use Bitrix\Translate\Index;

class PhraseIndexSearch
{
	const SEARCH_METHOD_EQUAL = 'equal';
	const SEARCH_METHOD_CASE_SENSITIVE = 'case_sensitive';
	const SEARCH_METHOD_EXACT_WORD = 'exact_word';
	const SEARCH_METHOD_START_WITH = 'start_with';
	const SEARCH_METHOD_END_WITH = 'end_with';
	const SEARCH_METHOD_ALL_PART = 'all_part';
	const SEARCH_METHOD_ANY_PART = 'any_part';


	/**
	 * Performs search query and returns result.
	 *
	 * @param array $params Orm type params for the query.
	 * @return Main\ORM\Query\Query
	 * @throws Main\SystemException
	 */
	public static function query($params = [])
	{
		list($select, $runtime, $filter) = self::processParams($params);

		/** @var \Bitrix\Main\ORM\Entity $entity */
		$entity = Index\Internals\PathPhraseIndexReferenceTable::getEntity();
		foreach ($runtime as $field)
		{
			$entity->addField($field);
		}

		return new Main\ORM\Query\Query($entity);
	}


	/**
	 * Counts rows in search result.
	 *
	 * @param array $filterIn Filter params.
	 * @return int
	 * @throws Main\SystemException
	 */
	public static function getCount($filterIn)
	{
		list($select, $runtime, $filter) = self::processParams(['filter' => $filterIn]);

		/** @var \Bitrix\Main\ORM\Entity $entity */
		$entity = Index\Internals\PathPhraseIndexReferenceTable::getEntity();
		foreach ($runtime as $field)
		{
			$entity->addField($field);
		}

		$query = new Main\ORM\Query\Query($entity);

		$query
			->addSelect(new Main\ORM\Fields\ExpressionField('CNT', 'COUNT(1)'))
			->setFilter($filter);

		$result = $query->exec()->fetch();

		return (int)$result['CNT'];
	}


	/**
	 * Searches phrase by index.
	 *
	 * @param array $params Orm type params for the query.
	 * @return Main\ORM\Query\Result
	 * @throws Main\SystemException
	 */
	public static function getList($params)
	{
		list($select, $runtime, $filter) = self::processParams($params);

		$executeParams = array(
			'select' => array_merge(
				[
					'PATH_ID' => 'PATH_ID',
					'PHRASE_CODE' => 'CODE',
					'FILE_PATH' => 'PATH.PATH',
					'TITLE' => 'PATH.NAME',
				],
				$select
			),
			'runtime' => $runtime,
			'filter' => $filter,
		);

		if (isset($params['order']))
		{
			$executeParams['order'] = $params['order'];
		}
		if (isset($params['offset']))
		{
			$executeParams['offset'] = $params['offset'];
		}
		if (isset($params['limit']))
		{
			$executeParams['limit'] = $params['limit'];
		}
		if (isset($params['count_total']))
		{
			$executeParams['count_total'] = true;
		}

		return Index\Internals\PathPhraseIndexReferenceTable::getList($executeParams);
	}


	/**
	 * Processes select and filter params to convert them into orm type.
	 *
	 * @param array $params Orm type params for the query.
	 * @return array
	 * @throws Main\ArgumentException
	 * @throws Main\SystemException
	 */
	private static function processParams($params)
	{
		$select = $runtime = $filterIn = $filterOut = array();
		if (isset($params['filter']))
		{
			if (is_object($params['filter']))
			{
				$filterIn = clone $params['filter'];
			}
			else
			{
				$filterIn = $params['filter'];
			}
		}

		$enabledLanguages = Translate\Config::getEnabledLanguages();
		$languageUpperKeys = array_combine($enabledLanguages, array_map('strtoupper', $enabledLanguages));

		$selectedLanguages = array();
		foreach ($languageUpperKeys as $langId => $langUpper)
		{
			$alias = "{$langUpper}_LANG";
			if (isset($params['select']) && in_array($alias, $params['select']))
			{
				$selectedLanguages[] = $langId;
			}
			elseif (isset($params['order'], $params['order'][$alias]))
			{
				$selectedLanguages[] = $langId;
			}
			elseif (isset($filterIn['LANGUAGE_ID']) && $filterIn['LANGUAGE_ID'] == $langId)
			{
				$selectedLanguages[] = $langId;
			}
		}
		if (empty($selectedLanguages))
		{
			$selectedLanguages = $enabledLanguages;
		}

		if (!isset($filterIn['PHRASE_ENTRY']))
		{
			$filterIn['PHRASE_ENTRY'] = array();
		}
		if (!isset($filterIn['CODE_ENTRY']))
		{
			$filterIn['CODE_ENTRY'] = array();
		}

		// top folder
		if (!empty($filterIn['PATH']))
		{
			$topIndexPath = Index\PathIndex::loadByPath($filterIn['PATH']);
			if ($topIndexPath instanceof Index\PathIndex)
			{
				$filterOut['>=PATH.LEFT_MARGIN'] = $topIndexPath->getLeftMargin();
				$filterOut['<=PATH.RIGHT_MARGIN'] = $topIndexPath->getRightMargin();
			}
			unset($filterIn['PATH']);
		}

		// pathId + code
		if (!class_exists('Bitrix\\Translate\\Index\\Internals\\PathPhraseIndexReferenceTable'))
		{
			$subQuery = (new Main\ORM\Query\Query(Index\Internals\PhraseIndexTable::getEntity()))
				->setSelect(['PATH_ID', 'CODE'])
				->setGroup(['PATH_ID', 'CODE']);

			Main\ORM\Entity::compileEntity(
				'PathPhraseIndexReference',
				array(
					'PATH_ID' => array('data_type' => 'string'),
					'CODE' => array('data_type' => 'string'),
				),
				array(
					'table_name' => '('.$subQuery->getQuery().')',
					'namespace' => 'Bitrix\\Translate\\Index\\Internals',
				)
			);
		}

		// search by code
		if (!empty($filterIn['INCLUDE_PHRASE_CODES']))
		{
			$codes = preg_split("/[\r\n\t,; ]+/".BX_UTF_PCRE_MODIFIER, $filterIn['INCLUDE_PHRASE_CODES']);
			$codes = array_filter($codes);
			if (count($codes) > 0)
			{
				$useLike = false;
				foreach ($codes as $code)
				{
					if (strpos($code, '%') !== false)
					{
						$useLike = true;
						break;
					}
				}
				if ($useLike)
				{
					$filterOut['=%CODE'] = $codes;
				}
				else
				{
					$filterOut['=CODE'] = $codes;
				}
			}
			unset($filterIn['INCLUDE_PHRASE_CODES']);
		}
		if (!empty($filterIn['EXCLUDE_PHRASE_CODES']))
		{
			$codes = preg_split("/[\r\n\t,; ]+/".BX_UTF_PCRE_MODIFIER, $filterIn['EXCLUDE_PHRASE_CODES']);
			$codes = array_filter($codes);
			if (count($codes) > 0)
			{
				$useLike = false;
				foreach ($codes as $code)
				{
					if (strpos($code, '%') !== false)
					{
						$useLike = true;
						break;
					}
				}
				if ($useLike)
				{
					$filterOut["!=%CODE"] = $codes;
				}
				else
				{
					$filterOut["!=CODE"] = $codes;
				}
			}
			unset($filterIn['EXCLUDE_PHRASE_CODES']);
		}

		if (!empty($filterIn['PHRASE_CODE']))
		{
			if (in_array(self::SEARCH_METHOD_CASE_SENSITIVE, $filterIn['CODE_ENTRY']))
			{
				if (in_array(self::SEARCH_METHOD_EQUAL, $filterIn['CODE_ENTRY']))
				{
					$filterOut["=CODE"] = $filterIn['PHRASE_CODE'];
				}
				elseif (in_array(self::SEARCH_METHOD_START_WITH, $filterIn['CODE_ENTRY']))
				{
					$filterOut["=%CODE"] = $filterIn['PHRASE_CODE'].'%';
				}
				elseif (in_array(self::SEARCH_METHOD_END_WITH, $filterIn['CODE_ENTRY']))
				{
					$filterOut["=%CODE"] = '%'.$filterIn['PHRASE_CODE'];
				}
				else
				{
					$filterOut["=%CODE"] = '%'.$filterIn['PHRASE_CODE'].'%';
				}
			}
			else
			{
				$runtime[] = new Main\ORM\Fields\ExpressionField('CODE_UPPER', 'UPPER(%s)', 'CODE');
				if (in_array(self::SEARCH_METHOD_EQUAL, $filterIn['CODE_ENTRY']))
				{
					$filterOut['=CODE_UPPER'] = strtoupper($filterIn['PHRASE_CODE']);
				}
				elseif (in_array(self::SEARCH_METHOD_START_WITH, $filterIn['CODE_ENTRY']))
				{
					$filterOut['=%CODE_UPPER'] = strtoupper($filterIn['PHRASE_CODE']).'%';
				}
				elseif (in_array(self::SEARCH_METHOD_END_WITH, $filterIn['CODE_ENTRY']))
				{
					$filterOut['=%CODE_UPPER'] = '%'.strtoupper($filterIn['PHRASE_CODE']);
				}
				else
				{
					$filterOut['=%CODE_UPPER'] = '%'.strtoupper($filterIn['PHRASE_CODE']).'%';
				}
			}
		}
		unset($filterIn['PHRASE_CODE'], $filterIn['CODE_ENTRY']);

		$runtime[] = new Main\ORM\Fields\Relations\Reference(
			'PATH',
			Index\Internals\PathIndexTable::class,
			Main\ORM\Query\Join::on('ref.ID', '=', 'this.PATH_ID'),
			array('join_type' => 'INNER')
		);

		$filterOut['=PATH.IS_DIR'] = 'N';

		$replaceLangId = function(&$val)
		{
			$val = Translate\IO\Path::replaceLangId($val, '#LANG_ID#');
		};
		$trimSlash = function(&$val)
		{
			if (substr($val, -4) === '.php')
			{
				$val = '/'. trim($val, '/');
			}
			else
			{
				$val = '/'. trim($val, '/'). '/%';
			}
		};

		if (!empty($filterIn['INCLUDE_PATHS']))
		{
			$pathIncludes = preg_split("/[\r\n\t,; ]+/".BX_UTF_PCRE_MODIFIER, $filterIn['INCLUDE_PATHS']);
			$pathIncludes = array_filter($pathIncludes);
			if (count($pathIncludes) > 0)
			{
				$pathPathIncludes = array();
				$pathNameIncludes = array();
				foreach ($pathIncludes as $testPath)
				{
					if (!empty($testPath) && trim($testPath) !== '')
					{
						if (strpos($testPath, '/') === false)
						{
							$pathNameIncludes[] = $testPath;
						}
						else
						{
							$pathPathIncludes[] = $testPath;
						}
					}
				}
				if (count($pathNameIncludes) > 0 && count($pathPathIncludes) > 0)
				{
					array_walk($pathNameIncludes, $replaceLangId);
					array_walk($pathPathIncludes, $replaceLangId);
					array_walk($pathPathIncludes, $trimSlash);
					$filterOut[] = array(
						'LOGIC' => 'OR',
						'=PATH.NAME' => $pathNameIncludes,
						'%=PATH.PATH' => $pathPathIncludes,
					);
				}
				elseif (count($pathNameIncludes) > 0)
				{
					array_walk($pathNameIncludes, $replaceLangId);
					$filterOut['=PATH.NAME'] = $pathNameIncludes;
				}
				elseif (count($pathPathIncludes) > 0)
				{
					array_walk($pathPathIncludes, $replaceLangId);
					array_walk($pathPathIncludes, $trimSlash);
					$filterOut['%=PATH.PATH'] = $pathPathIncludes;
				}
			}
			unset($testPath, $pathIncludes, $pathNameIncludes, $pathPathIncludes);
		}
		if (!empty($filterIn['EXCLUDE_PATHS']))
		{
			$pathExcludes = preg_split("/[\r\n\t,; ]+/".BX_UTF_PCRE_MODIFIER, $filterIn['EXCLUDE_PATHS']);
			$pathExcludes = array_filter($pathExcludes);
			if (count($pathExcludes) > 0)
			{
				$pathPathExcludes = array();
				$pathNameExcludes = array();
				foreach ($pathExcludes as $testPath)
				{
					if (!empty($testPath) && trim($testPath) !== '')
					{
						if (strpos($testPath, '/') === false)
						{
							$pathNameExcludes[] = $testPath;
						}
						else
						{
							$pathPathExcludes[] = $testPath;
						}
					}
				}
				if (count($pathNameExcludes) > 0 && count($pathPathExcludes) > 0)
				{
					array_walk($pathNameExcludes, $replaceLangId);
					array_walk($pathPathExcludes, $replaceLangId);
					array_walk($pathPathExcludes, $trimSlash);
					$filterOut[] = array(
						'LOGIC' => 'AND',
						'!=PATH.NAME' => $pathNameExcludes,
						'!=%PATH.PATH' => $pathPathExcludes,
					);
				}
				elseif (count($pathNameExcludes) > 0)
				{
					array_walk($pathNameExcludes, $replaceLangId);
					$filterOut["!=PATH.NAME"] = $pathNameExcludes;
				}
				elseif (count($pathPathExcludes) > 0)
				{
					array_walk($pathPathExcludes, $replaceLangId);
					array_walk($pathPathExcludes, $trimSlash);
					$filterOut["!=%PATH.PATH"] = $pathPathExcludes;
				}
			}
			unset($testPath, $pathExcludes, $pathPathExcludes, $pathNameExcludes);
		}
		unset($filterIn['INCLUDE_PATHS'], $filterIn['EXCLUDE_PATHS']);

		// search by phrase
		if (!empty($filterIn['PHRASE_TEXT']) && empty($filterIn['LANGUAGE_ID']))
		{
			$filterIn['LANGUAGE_ID'] = Loc::getCurrentLang();
		}


		$phraseSearch = array(
			'LOGIC' => 'AND'
		);
		foreach ($languageUpperKeys as $langId => $langUpper)
		{
			$searchPhraseByLang = ($langId == $filterIn['LANGUAGE_ID']);
			if (
				!in_array($langId, $selectedLanguages) &&
				!$searchPhraseByLang &&
				!Main\Localization\Translation::isDefaultTranslationLang($langId)
			)
			{
				continue;
			}

			$alias = "{$langUpper}_LANG";
			$tblAlias = "Phrase{$alias}";
			$fieldAlias = "{$tblAlias}.PHRASE";

			$runtime[] = new Main\ORM\Fields\Relations\Reference(
				$tblAlias,
				Index\Internals\PhraseIndexTable::class,
				Main\ORM\Query\Join::on('ref.PATH_ID', '=', 'this.PATH_ID')
								   ->whereColumn('ref.CODE', '=', 'this.CODE')
								   ->where('ref.LANG_ID', '=', $langId),
				array('join_type' => $searchPhraseByLang ? 'INNER' : 'LEFT')
			);

			$select[$alias] = "{$tblAlias}.PHRASE";
			$select["{$langUpper}_FILE_ID"] = "{$tblAlias}.FILE_ID";

			if ($searchPhraseByLang && !empty($filterIn['PHRASE_TEXT']))
			{
				$sqlHelper = Main\Application::getConnection()->getSqlHelper();
				$str = $sqlHelper->forSql($filterIn['PHRASE_TEXT']);

				$exact = in_array(self::SEARCH_METHOD_EXACT_WORD, $filterIn['PHRASE_ENTRY']);
				$case = in_array(self::SEARCH_METHOD_CASE_SENSITIVE, $filterIn['PHRASE_ENTRY']);
				$start = in_array(self::SEARCH_METHOD_START_WITH, $filterIn['PHRASE_ENTRY']);
				$end = in_array(self::SEARCH_METHOD_END_WITH, $filterIn['PHRASE_ENTRY']);
				$equal = in_array(self::SEARCH_METHOD_EQUAL, $filterIn['PHRASE_ENTRY']);

				// use fulltext index to help like operator
				$textStr = preg_replace("/^\W+/i".BX_UTF_PCRE_MODIFIER, '', $filterIn['PHRASE_TEXT']);
				$textStr = preg_replace("/\W+$/i".BX_UTF_PCRE_MODIFIER, '', $textStr);
				$textStr = preg_replace("/\W+/i".BX_UTF_PCRE_MODIFIER, ' ', $textStr);
				$textStr = preg_replace("/\w{1,4}/i".BX_UTF_PCRE_MODIFIER, '', $textStr);
				if (strlen($textStr) > 4)
				{
					if ($exact)
					{
						// identical full text match
						// MATCH(PHRASE) AGAINST ('+smth' IN BOOLEAN MODE)
						$phraseSearch["*={$fieldAlias}"] = $textStr;
					}
					else
					{
						// use fulltext index to help like operator
						// partial full text match
						// MATCH(PHRASE) AGAINST ('+smth*' IN BOOLEAN MODE)
						$phraseSearch["*{$fieldAlias}"] = $textStr;
					}
				}

				if ($equal)
				{
					$likeStr = "{$str}";
				}
				elseif ($start)
				{
					$likeStr = "{$str}%%";
				}
				elseif ($end)
				{
					$likeStr = "%%{$str}";
				}
				else
				{
					$likeStr = "%%{$str}%%";
				}

				if ($case)
				{
					$binarySensitive = 'BINARY';
					$regStr = $str;
				}
				else
				{
					$binarySensitive = '';
					$regStr = '';
					$regChars = ['?', '*', '|', '[', ']', '(', ')', '-', '+'];
					for ($p = 0, $len = Translate\Text\StringHelper::getLength($str); $p < $len; $p++)
					{
						$c0 = Translate\Text\StringHelper::getSubstring($str, $p, 1);
						if (in_array($c0, $regChars))
						{
							$regStr .= "\\\\". $c0;
							continue;
						}
						$c1 = Translate\Text\StringHelper::changeCaseToLower($c0);
						$c2 = Translate\Text\StringHelper::changeCaseToUpper($c0);
						if ($c0 != $c1)
						{
							$regStr .= '('.$c0.'|'.$c1.'){1}';
						}
						elseif ($c0 != $c2)
						{
							$regStr .= '('.$c0.'|'.$c2.'){1}';
						}
						else
						{
							$regStr .= $c0;
						}
					}
				}

				// Exact word match
				if ($exact)
				{
					if ($equal)
					{
						$regStr = "^[[:<:]]({$regStr})[[:>:]]$";
					}
					elseif ($start)
					{
						$regStr = "^[[:<:]]({$regStr})[[:>:]].*";
					}
					elseif ($end)
					{
						$regStr = ".*[[:<:]]({$regStr})[[:>:]]$";
					}
					else
					{
						$regStr = "[[:<:]]({$regStr})[[:>:]]";
					}
				}

				// regexp binary mode works not exactly we want using like binary to fix it
				$runtime[] =
					new Main\ORM\Fields\ExpressionField(
						'PHRASE_LIKE',
						"CASE WHEN %s LIKE $binarySensitive '{$likeStr}' THEN 1 ELSE 0 END",
						"{$fieldAlias}"
					);
				$phraseSearch["=PHRASE_LIKE"] = 1;

				$runtime[] =
					new Main\ORM\Fields\ExpressionField(
						'PHRASE_REGEXP',
						"CASE WHEN %s REGEXP '{$regStr}' THEN 1 ELSE 0 END",
						"{$fieldAlias}"
					);

				$phraseSearch["=PHRASE_REGEXP"] = 1;
			}
		}
		unset($langId, $langUpper, $alias, $tblAlias, $fieldAlias,
			$filterIn['PHRASE_ENTRY'], $filterIn['PHRASE_TEXT'], $filterIn['LANGUAGE_ID']);

		// is any file exists in main rep
		if (Main\Localization\Translation::useTranslationRepository())
		{
			$statement = '';
			$fields = array();
			foreach ($languageUpperKeys as $langId => $langUpper)
			{
				if (Main\Localization\Translation::isDefaultTranslationLang($langId))
				{
					$alias = "{$langUpper}_LANG";
					$fields[] = "Phrase{$alias}.FILE_ID";
					$statement .= ' WHEN %s IS NOT NULL THEN 1 ';
				}
			}
			unset($langId, $langUpper, $alias, $tblAlias, $fieldAlias);

			$runtime[] =
				new Main\ORM\Fields\ExpressionField(
					'IS_EXIST',
					"CASE {$statement} ELSE 0 END",
					$fields
				);
			$select[] = 'IS_EXIST';
		}

		if (count($phraseSearch) > 1)
		{
			$filterOut[] = $phraseSearch;
		}

		if (!empty($filterIn['FILE_NAME']))
		{
			$filterOut["=%PATH.NAME"] = '%'. $filterIn['FILE_NAME']. '%';
			unset($filterIn['FILE_NAME']);
		}
		if (!empty($filterIn['FOLDER_NAME']))
		{
			$filterOut['=%PATH.PATH'] = '%/'. $filterIn['FOLDER_NAME']. '/%';
			unset($filterIn['FOLDER_NAME']);
		}

		foreach ($filterIn as $key => $value)
		{
			if (in_array($key, ['tabId', 'FILTER_ID', 'PRESET_ID', 'FILTER_APPLIED', 'FIND']))
			{
				continue;
			}
			$filterOut[$key] = $value;
		}

		return array($select, $runtime, $filterOut);
	}
}
