<?php
namespace Bitrix\Translate\Controller\Index;

use Bitrix\Main;
use Bitrix\Translate;
use Bitrix\Translate\Index;


/**
 * Harvester of the lang folder disposition.
 */
class CollectLangPath
	extends Translate\Controller\Action
	implements Translate\Controller\ITimeLimit, Translate\Controller\IProcessParameters
{
	use Translate\Controller\Stepper;
	use Translate\Controller\ProcessParams;

	/** @var string */
	private $seekPath;

	/** @var int */
	private $seekOffset;

	/** @var string[] */
	private $pathList;


	/**
	 * \Bitrix\Main\Engine\Action constructor.
	 *
	 * @param string $name Action name.
	 * @param Main\Engine\Controller $controller Parent controller object.
	 * @param array $config Additional configuration.
	 */
	public function __construct($name, Main\Engine\Controller $controller, $config = array())
	{
		$this->keepField(['seekPath', 'pathList', 'seekOffset']);

		parent::__construct($name, $controller, $config);
	}

	/**
	 * Runs controller action.
	 *
	 * @param string $path Path to indexing.
	 * @return array
	 */
	public function run($path = '')
	{
		if (empty($path))
		{
			$path = Translate\Config::getDefaultPath();
		}

		$path = '/'. trim($path, '/.\\');

		// List of files and folders
		if ($this->isNewProcess)
		{
			$pathList = $this->controller->getRequest()->get('pathList');

			if (!empty($pathList))
			{
				$pathList = preg_split("/[\r\n]+/", $pathList);
				array_walk($pathList, 'trim');
				$pathList = array_unique(array_filter($pathList));
			}

			if (empty($pathList))
			{
				$pathList = array($path);
			}

			$checkIndexExists = $this->controller->getRequest()->get('checkIndexExists') === 'Y';

			foreach ($pathList as $testPath)
			{
				if ($checkIndexExists)
				{
					$indexPath = Index\PathIndex::loadByPath($testPath);
					if ($indexPath instanceof Index\PathIndex)
					{
						if ($indexPath->getIndexed())
						{
							continue;// skip indexing if index exists
						}
					}
				}

				if (substr($testPath, -4) === '.php')
				{
					if (!Translate\IO\Path::isLangDir($testPath))
					{
						continue;// skip non lang files
					}
				}

				$this->pathList[] = $testPath;
			}

			if (empty($this->pathList))
			{
				return array(
					'STATUS' => Translate\Controller\STATUS_COMPLETED,
				);
			}

			$this->isNewProcess = false;
			$this->instanceTimer()->setTimeLimit(5);
		}

		return $this->performStep('runIndexing');
	}

	/**
	 * Collects lang folder paths.
	 *
	 * @return array
	 */
	private function runIndexing()
	{
		$indexer = new Index\PathLangCollection();

		$processedItemCount = 0;

		for ($pos = ((int)$this->seekOffset > 0 ? (int)$this->seekOffset : 0), $total = count($this->pathList); $pos < $total; $pos ++)
		{
			$testPath = $this->pathList[$pos];

			if (preg_match("#(.+/lang)(/?\w*)#", $testPath, $matches))
			{
				$filter = new Translate\Filter(['path' => $matches[1]]);
				$indexer->purge($filter);

				$processedItemCount += $indexer->collect($filter);//++1
			}
			else
			{
				$filter = new Translate\Filter();
				$filter->path = $testPath;

				$seek = new Translate\Filter();
				$seek->lookForSeek = false;

				if (!empty($this->seekPath))
				{
					$seek->path = $this->seekPath;
					$seek->lookForSeek = true;
				}
				else
				{
					$indexer->purge($filter);
				}

				$processedItemCount += $indexer->collect($filter, $this->instanceTimer(), $seek);

				if ($this->instanceTimer()->hasTimeLimitReached())
				{
					if (isset($seek->nextPath))
					{
						$this->seekPath = $seek->nextPath;
					}
					break;
				}

				$this->seekPath = null;
			}

			if (isset($this->pathList[$pos + 1]))
			{
				$this->seekOffset = $pos + 1;//next
			}
			else
			{
				$this->seekOffset = null;
				$this->declareAccomplishment();
				$this->clearProgressParameters();
			}

			if ($this->instanceTimer()->hasTimeLimitReached())
			{
				break;
			}
		}

		$this->processedItems += $processedItemCount;
		$this->totalItems += $processedItemCount;

		if ($this->instanceTimer()->hasTimeLimitReached() !== true)
		{
			$this->processedItems = $this->totalItems = (new Index\PathIndexCollection())->countItemsToProcess($filter);

			$this->declareAccomplishment();
			$this->clearProgressParameters();
		}

		return array(
			'PROCESSED_ITEMS' => $this->processedItems,
			'TOTAL_ITEMS' => $this->totalItems,
		);
	}
}