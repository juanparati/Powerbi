<?php


namespace Juanparati\PowerBI\Services;

use Juanparati\PowerBI\Models\DatasetModel;
use Juanparati\PowerBI\Models\RowModel;
use Juanparati\PowerBI\Models\TableModel;
use Juanparati\PowerBI\Responses\DeleteDatasetResponse;
use Juanparati\PowerBI\Responses\DeleteRowsResponse;
use Juanparati\PowerBI\Responses\GetDatasetResponse;
use Juanparati\PowerBI\Responses\GetTableResponse;
use Juanparati\PowerBI\Responses\PostDatasetResponse;
use Juanparati\PowerBI\Responses\PostRowsResponse;
use Juanparati\PowerBI\Responses\PutTableResponse;


/**
 * Class Dataset.
 *
 * @package Juanparati\PowerBI\Services
 */
class Dataset extends Service
{

	/**
	 * Base service url.
	 *
	 * @var string
	 */
	protected $base_url = 'https://api.powerbi.com/v1.0/myorg/';


	/**
	 * Post dataset
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_postdataset#examples
	 *
	 * @param DatasetModel $dataset
	 * @return PostDatasetResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function postDataset(DatasetModel $dataset) : PostDatasetResponse
	{
		$endpoint = $this->base_url . 'datasets';

		return $this->_postDataset($dataset, $endpoint);
	}


	/**
	 * Post dataset in group
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_postdatasetingroup
	 *
	 * @param DatasetModel $dataset
	 * @param string $group_id
	 * @return PostDatasetResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function postDatasetInGroup(DatasetModel $dataset, string $group_id) : PostDatasetResponse
	{
		$endpoint = $this->base_url . 'groups/' . $group_id . '/datasets';

		return $this->_postDataset($dataset, $endpoint);
	}


	/**
	 * Get all datasets.
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/datasets/getdatasets#examples
	 *
	 * @return GetDatasetResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function getDatasets() : GetDatasetResponse
	{
		$endpoint = $this->base_url . 'datasets';

		return $this->_getDataset($endpoint);
	}


	/**
	 * Get dataset
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/datasets/getdatasetbyid
	 *
	 * @param string $id
	 * @return GetDatasetResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function getDatasetById(string $id) : GetDatasetResponse
	{
		$endpoint = $this->base_url . 'datasets/' . $id;

		return $this->_getDataset($endpoint);
	}


	/**
	 * Delete dataset
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/datasets/deletedatasetbyid
	 *
	 * @param string $id
	 * @return DeleteDatasetResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function deleteDatasetById(string $id) : DeleteDatasetResponse
	{
		$endpoint = $this->base_url . 'datasets/' . $id;

		return $this->_deleteDataset($endpoint);
	}


	/**
	 * Delete dataset in group
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/datasets/deletedatasetbyidingroup
	 *
	 * @param string $id
	 * @param string $group_id
	 * @return DeleteDatasetResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function deleteDatasetByIdInGroup(string $id, string $group_id) : DeleteDatasetResponse
	{
		$endpoint = $this->base_url . 'groups/' . $group_id . '/datasets/' . $id;

		return $this->_deleteDataset($endpoint);
	}


	/**
	 * Get a table by dataset id.
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_gettables
	 *
	 * @param string $dataset_id
	 * @return GetTableResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function getTablesByDatasetId(string $dataset_id) : GetTableResponse
	{
		$endpoint = $this->base_url . 'datasets/' . $dataset_id . '/tables';

		return $this->_getTables($endpoint);
	}


	/**
	 * Get a table in group by dataset id.
	 *
	 * @param string $dataset_id
	 * @param string $group_id
	 * @return GetTableResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function getTablesByDatasetIdInGroup(string $dataset_id, string $group_id) : GetTableResponse
	{
		$endpoint = $this->base_url . 'groups/' . $group_id . '/datasets/' . $dataset_id . '/tables';

		return $this->_getTables($endpoint);
	}


	/**
	 * Updates table metadata and schema.
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_puttable
	 *
	 * @param TableModel $table
	 * @param string $table_name
	 * @param string $dataset_id
	 * @return PutTableResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function putTableByDatasetId(TableModel $table, string $table_name, string $dataset_id) : PutTableResponse
	{
		$endpoint = $this->base_url . 'datasets/' . $dataset_id . '/tables/' . $table_name;

		return $this->_putTable($table, $endpoint);
	}


	/**
	 * Updates table metadata and schema that belongs to a group.
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_postrowsingroup
	 *
	 * @param TableModel $table
	 * @param string $table_name
	 * @param string $dataset_id
	 * @param string $group_id
	 * @return PutTableResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function putTableByDatasetIdInGroup(TableModel $table, string $table_name, string $dataset_id, string $group_id) : PutTableResponse
	{
		$endpoint = $this->base_url . 'groups/' . $group_id . '/datasets/' . $dataset_id . '/tables/' . $table_name;

		return $this->_putTable($table, $endpoint);

	}


	/**
	 * Adds new data rows.
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_postrows
	 *
	 * @param $rows
	 * @param string $table_name
	 * @param string $dataset_id
	 * @return PostRowsResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function postRowsByDatasetId($rows, string $table_name, string $dataset_id) : PostRowsResponse
	{
		$endpoint = $this->base_url . 'datasets/' . $dataset_id . '/tables/' . $table_name . '/rows';

		$rows = $rows instanceof RowModel ? [$rows] : $rows;

		return $this->_postRows(['rows' => $rows], $endpoint);
	}


	/**
	 * Adds new data rows in group.
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_postrowsingroup
	 *
	 * @param $rows
	 * @param string $table_name
	 * @param string $dataset_id
	 * @param string $group_id
	 * @return PostRowsResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function postRowsByDatasetIdInGroup($rows, string $table_name, string $dataset_id, string $group_id) : PostRowsResponse
	{
		$endpoint = $this->base_url . 'groups/' . $group_id . '/datasets/' . $dataset_id . '/tables/' . $table_name . '/rows';

		$rows = $rows instanceof RowModel ? [$rows] : $rows;

		return $this->_postRows(['rows' => $rows], $endpoint);
	}


	/**
	 * Delete all rows
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_deleterows
	 *
	 * @param string $table_name
	 * @param string $dataset_id
	 * @return DeleteRowsResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function deleteRowsByDatasetId(string $table_name, string $dataset_id) : DeleteRowsResponse
	{
		$endpoint = $this->base_url . 'datasets/' . $dataset_id . '/tables/' . $table_name . '/rows';

		return $this->_deleteRows($endpoint);
	}


	/**
	 * Delete all rows by group.
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_deleterowsingroup
	 *
	 * @param string $table_name
	 * @param string $dataset_id
	 * @param string $group_id
	 * @return DeleteRowsResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function deleteRowsByDatasetIdInGroup(string $table_name, string $dataset_id, string $group_id) : DeleteRowsResponse
	{
		$endpoint = $this->base_url . 'groups/' . $group_id . '/datasets/' . $dataset_id . '/tables/' . $table_name . '/rows';

		return $this->_deleteRows($endpoint);
	}


	/**
	 * Delete all rows against a variable endpoint.
	 *
	 * @param string $endpoint
	 * @return DeleteRowsResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	protected function _deleteRows(string $endpoint) : DeleteRowsResponse
	{
		return new DeleteRowsResponse($this->client->request('DELETE', $endpoint));
	}


	/**
	 * Post rows against a variable endpoint.
	 *
	 * @param array $rows
	 * @param string $endpoint
	 * @return PostRowsResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	protected function _postRows(array $rows, string $endpoint) : PostRowsResponse
	{
		return new PostRowsResponse($this->client->request('POST', $endpoint, $rows));
	}


	/**
	 * Updates table metadata and schema against a variable endpoint.
	 *
	 * @param TableModel $table
	 * @param $endpoint
	 * @return PutTableResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	protected function _putTable(TableModel $table, $endpoint) : PutTableResponse
	{
		return new PutTableResponse($this->client->request('PUT', $endpoint, $table));
	}


	/**
	 * Get table against a variable endpoint.
	 *
	 * @param string $endpoint
	 * @return GetTableResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	protected function _getTables(string $endpoint) : GetTableResponse
	{
		return new GetTableResponse($this->client->request('GET', $endpoint));
	}


	/**
	 * Get dataset against a variable endpoint.
	 *
	 * @param string $endpoint
	 * @return GetDatasetResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	protected function _getDataset(string $endpoint) : GetDatasetResponse
	{
		return new GetDatasetResponse($this->client->request('GET', $endpoint));
	}


	/**
	 * Delete a dataset against a variable endpoint.
	 *
	 * @param string $endpoint
	 * @return DeleteDatasetResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	protected function _deleteDataset(string $endpoint) : DeleteDatasetResponse
	{
		return new DeleteDatasetResponse($this->client->request('DELETE', $endpoint));
	}


	/**
	 * Post a dataset against a variable endpoint.
	 *
	 * @param DatasetModel $dataset
	 * @param string $endpoint
	 * @return PostDatasetResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	protected function _postDataset(DatasetModel $dataset, string $endpoint) : PostDatasetResponse
	{
		return new PostDatasetResponse($this->client->request('POST', $endpoint, $dataset));
	}

}
