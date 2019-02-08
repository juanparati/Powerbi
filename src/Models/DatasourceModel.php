<?php

namespace Juanparati\PowerBI\Models;


/**
 * Class Datasource.
 *
 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_postdataset#datasource
 *
 * @package Juanparati\PowerBI\Models
 */
class DatasourceModel extends Model
{

	/**
	 * The datasource connection details.
	 *
	 * @var DatasourceConnectionDetails|null
	 */
	public $connectionDetails = null;


	/**
	 * The datasource connection string. Available only for DirectQuery.
	 *
	 * @var string|null
	 */
	public $connectionString = null;


	/**
	 * The bound datasource id. Empty when not bound to a gateway.
	 *
	 * @var string|null
	 */
	public $datasourceId = null;


	/**
	 * The datasource type.
	 *
	 * @var string|null
	 */
	public $datasourceType = null;


	/**
	 * The bound gateway id. Empty when not bound to a gateway.
	 *
	 * @var string|null
	 */
	public $gatewayId = null;


	/**
	 * The datasource name. Available only for DirectQuery.
	 *
	 * @var string|null
	 */
	public $name = null;

}
