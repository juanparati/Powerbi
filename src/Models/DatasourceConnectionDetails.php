<?php

namespace Juanparati\PowerBI\Models;


/**
 * Class DatasourceConnectionDetails.
 *
 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_postdataset#datasourceconnectiondetails
 *
 * @package Juanparati\PowerBI\Models
 */
class DatasourceConnectionDetails extends Model
{

	/**
	 * The connection database.
	 *
	 * @var string
	 */
	public $database = '';


	/**
	 * The connection server.
	 *
	 * @var string
	 */
	public $server = '';


	/**
	 * The connection url.
	 *
	 * @var string
	 */
	public $url = '';

}
