<?php


namespace Juanparati\PowerBI\Tests\Services;


use Juanparati\PowerBI\Enums\DatasetModeEnum;
use Juanparati\PowerBI\Enums\DatatypesEnum;
use Juanparati\PowerBI\Models\ColumnModel;
use Juanparati\PowerBI\Models\DatasetModel;
use Juanparati\PowerBI\Models\TableModel;
use Juanparati\PowerBI\Services\Dataset;
use Juanparati\PowerBI\Tests\PowerBITest;



/**
 * Class DatasetTest.
 *
 * @package Juanparati\PowerBI\Tests\Services
 */
final class DatasetTest extends PowerBITest
{


	/**
	 * Test dataset name.
	 *
	 * @var string
	 */
	protected static $test_dataset = 'test_';


	/**
	 * Transition data used across different tests.
	 *
	 * @var array
	 */
	protected static $transition = [];


	/**
	 * Execute before all tests.
	 *
	 * @throws \Exception
	 */
	public static function setUpBeforeClass() : void
	{
		parent::setUpBeforeClass();

		static::$test_dataset .= uniqid();
	}


	/**
	 * Test dataset creation.
	 *
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \ReflectionException
	 */
	public function testPostDatasetTest()
	{
		$dataset 			  = new DatasetModel();
		$dataset->name 		  = static::$test_dataset;
		$dataset->defaultMode = DatasetModeEnum::PUSH;
		$dataset->tables 	  = [new TableModel()];
		$dataset->tables[0]->name = 'mytable';

		$data_types = (new \ReflectionClass(DatatypesEnum::class))->getConstants();
		$dataset->tables[0]->columns = [];

		foreach ($data_types as $data_type)
		{
			$dataset->tables[0]->columns[]= new ColumnModel([
				'name' 	 	=> 'column_' . count($dataset->tables[0]->columns),
				'dataType'  => $data_type
			]);
		}

		$response = (new Dataset(static::$client))->postDataset($dataset);

		$this->assertTrue($response->isOk());

		$result = $response->response(true);

		$this->assertArrayHasKey('id', $result);

		static::$transition['column_id'] = $result['id'];
	}


	/**
	 * Test get dataset list.
	 *
	 * @depends testPostDatasetTest
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function testGetDatasets()
	{
		$response = (new Dataset(static::$client))->getDatasets();

		$this->assertTrue($response->isOk());
		$this->assertCount(1, array_filter($response->response(true)['value'], function ($dataset) {
			return $dataset['id'] === static::$transition['column_id'];
		}));
	}


	/**
	 * Test add rows.
	 *
	 * @depends testGetDatasets
	 * @throws \ReflectionException
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function testPushRows()
	{

		$rows = [];

		$data_types = (new \ReflectionClass(DatatypesEnum::class))->getConstants();

		for ($i = 0; $i < rand(1, 50); $i++)
		{
			$column_num = 0;

			foreach ($data_types as $data_type)
			{

				$value = uniqid();

				switch ($data_type)
				{
					case DatatypesEnum::INT64:
						$value = rand(0, 5000);
						break;

					case DatatypesEnum::BOOL:
						$value = (bool) rand(0, 1);
						break;

					case DatatypesEnum::DOUBLE:
						$value = $randomFloat = rand(0, 100) / 10;
						break;

					case DatatypesEnum::DATETIME:
						$value = date('d/m/Y');
						break;
				}

				$rows[$i]['column_' . $column_num] = $value;

				$column_num++;
			}
		}

		$response = (new Dataset(static::$client))->postRowsByDatasetId($rows, 'mytable', static::$transition['column_id']);

		$this->assertTrue($response->isOk());

	}


	/**
	 * Test delete dataset
	 *
	 * @depends testGetDatasets
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function testDeleteDataset()
	{
		$dataset = new Dataset(static::$client);

		$response = $dataset->deleteDatasetById(static::$transition['column_id']);

		$this->assertTrue($response->isOk());

		$this->expectExceptionCode(404);
		$dataset->getDatasetById(static::$transition['column_id']);
	}

}
