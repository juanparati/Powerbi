<?php

namespace Juanparati\PowerBI\Models;


/**
 * Class Table.
 *
 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_postdataset#table
 *
 * @package Juanparati\PowerBI\Models
 */
class TableModel extends Model
{

	/**
	 * The column schema for this table.
	 *
	 * @var ColumnModel[]|null
	 */
	public $columns = null;


	/**
	 * The measures within this table.
	 *
	 * @var MeasureModel[]|null
	 */
	public $measures = null;


	/**
	 * The table name.
	 *
	 * @var string
	 */
	public $name = '';


	/**
	 * The data rows within this table.
	 *
	 * @var RowModel[]|null
	 */
	public $rows = null;

}
