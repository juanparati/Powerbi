<?php

namespace Juanparati\PowerBI\Responses;


/**
 * Class GetGroupResponse.
 *
 * @package Juanparati\PowerBI\Responses
 */
class GetGroupResponse extends Response
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
		200 => 'ok'
	];

}
