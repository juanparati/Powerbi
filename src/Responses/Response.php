<?php

namespace Juanparati\PowerBI\Responses;


use Juanparati\PowerBI\Contracts\ResponseContract;
use Psr\Http\Message\ResponseInterface;


/**
 * Class Response.
 *
 * @package Juanparati\PowerBI\Responses
 */
abstract class Response implements ResponseContract
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
		201 => 'created',
		202 => 'accepted',
	];


	/**
	 * Response obtained.
	 *
	 * @var ResponseInterface
	 */
	protected $response;


	/**
	 * Current status.
	 *
	 * @var int
	 */
	protected $current_status;


	/**
	 * Response constructor.
	 *
	 * @param ResponseInterface $response
	 */
	public function __construct(ResponseInterface $response)
	{
		$this->response = $response;

		$this->current_status = $this->response->getStatusCode();
	}


	/**
	 * Get the unserialized response body.
	 *
	 * @param bool $as_assoc
	 * @return mixed|null
	 */
	public function response($as_assoc = false)
	{
		if ($this->has_body)
			return \GuzzleHttp\json_decode($this->response->getBody(), $as_assoc);

		return null;
	}


	/**
	 * Check if response is ok.
	 *
	 * @return bool
	 */
	public function isOk() : bool
	{
		return in_array($this->current_status, array_keys($this->valid_status));
	}


	/**
	 * Obtain the canonical status.
	 *
	 * @return mixed|string
	 */
	public function canonicalStatus() : string
	{
		return $this->isOk() ? $this->valid_status[$this->current_status] : 'error';
	}


	/**
	 * Get the original response.
	 *
	 * @return ResponseInterface
	 */
	public function getOriginalResponse() : ResponseInterface
	{
		return $this->response;
	}

}
