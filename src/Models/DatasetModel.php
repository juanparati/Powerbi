<?php


namespace Juanparati\PowerBI\Models;



/**
 * Class Dataset.
 *
 * Defines Dataset model.
 *
 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_postdataset
 *
 * @package Juanparati\PowerBI\Models
 */
class DatasetModel extends Model
{


	/**
	 * Dataset requires effective identity.
	 *
	 * @var bool|null
	 */
	public $IsEffectiveIdentityRequired = null;


	/**
	 * Dataset requires roles.
	 *
	 * @var bool|null
	 */
	public $IsEffectiveIdentityRolesRequired = null;


	/**
	 * Dataset requires an On-premises Data Gateway.
	 *
	 * @var bool|null
	 */
	public $IsOnPremGatewayRequired = null;


	/**
	 * Can this dataset be refreshed.
	 *
	 * @var bool|null
	 */
	public $IsRefreshable = null;


	/**
	 * Whether dataset allows adding new rows.
	 *
	 * @var bool|null
	 */
	public $addRowsAPIEnabled = null;


	/**
	 * The dataset owner.
	 *
	 * @var string|null
	 */
	public $configuredBy = null;


	/**
	 * The datasources associated with this dataset. Only relevant to the PostDataset API.
	 *
	 * @var DatasourceModel[]|null
	 */
	public $datasources = null;


	/**
	 * The datasources associated with this dataset. Only relevant to the PostDataset API.
	 *
	 * @var DatasetMode|null
	 */
	public $defaultMode = null;


	/**
	 * The dataset default data retention policy. Only relevant to the PostDataset API.
	 *
	 * @var string|null
	 */
	public $defaultRetentionPolicy = null;


	/**
	 * The dataset id.
	 *
	 * @var string|null
	 */
	public $id = null;


	/**
	 * The dataset name.
	 *
	 * @var string
	 */
	public $name = '';


	/**
	 * The dataset relationships. Only relevant to the PostDataset API.
	 *
	 * @var RelationshipModel[]|null
	 */
	public $relationships = null;


	/**
	 * The dataset tables. Only relevant to the PostDataset API.
	 *
	 * @var array
	 */
	public $tables = [];


	/**
	 * The dataset web url.
	 *
	 * @var string
	 */
	public $webUrl = null;

}
