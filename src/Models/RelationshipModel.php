<?php

namespace Juanparati\PowerBI\Models;


use Juanparati\PowerBI\Enums\CrossFilteringBehaviorEnum;


/**
 * Class Relationship.
 *
 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_postdataset#relationship
 *
 * @package Juanparati\PowerBI\Models
 */
class RelationshipModel extends Model
{

	/**
	 * The filter direction of the relationship
	 *
	 * @var string
	 */
	public $crossFilteringBehavior = CrossFilteringBehaviorEnum::ONE_DIRECTION;


	/**
	 * The name of the foreign key column.
	 *
	 * @var string
	 */
	public $fromColumn = '';


	/**
	 * The name of the foreign key table.
	 *
	 * @var string
	 */
	public $fromTable = '';


	/**
	 * The relationship name and identifier.
	 *
	 * @var string
	 */
	public $name = '';


	/**
	 * The name of the primary key column.
	 *
	 * @var string
	 */
	public $toColumn = '';


	/**
	 * The name of the primary key table.
	 *
	 * @var string
	 */
	public $toTable = '';

}
