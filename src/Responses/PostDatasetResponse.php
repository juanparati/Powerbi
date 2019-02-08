<?php

namespace Juanparati\PowerBI\Responses;


/**
 * Class PostDatasetResponse.
 *
 * @package Juanparati\PowerBI\Responses
 */
class PostDatasetResponse extends Response
{

	/**
	 * Indicates if response should have body.
	 *
	 * @var bool
	 */
	protected $has_body = true;


	/**
	 * Valid status.
	 *
	 * @var array
	 */
	protected $valid_status =
	[
		201 => 'created',
		202 => 'accepted',
	];

}
