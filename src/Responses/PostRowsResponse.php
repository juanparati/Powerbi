<?php

namespace Juanparati\PowerBI\Responses;


/**
 * Class PostRowsResponse.
 *
 * @package Juanparati\PowerBI\Responses
 */
class PostRowsResponse extends Response
{

	/**
	 * Indicates if response should have body.
	 *
	 * @var bool
	 */
	protected $has_body = false;


	/**
	 * Valid status.
	 *
	 * @var array
	 */
	protected $valid_status =
	[
		200 => 'ok',
	];

}
