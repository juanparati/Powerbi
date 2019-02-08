<?php


namespace Juanparati\PowerBI\Contracts;


use Psr\Http\Message\ResponseInterface;

/**
 * Interface ResponseContract.
 *
 * @package Juanparati\PowerBI\Contracts
 */
interface ResponseContract
{

	/**
	 * Response constructor.
	 *
	 * @param ResponseInterface $response
	 */
	public function __construct(ResponseInterface $response);


	/**
	 * Get the unserialized response body.
	 *
	 * @param bool $as_assoc
	 * @return mixed|null
	 */
	public function response($as_assoc = false);


	/**
	 * Check if response is ok.
	 *
	 * @return bool
	 */
	public function isOk() : bool;


	/**
	 * Obtain the canonical status.
	 *
	 * @return mixed|string
	 */
	public function canonicalStatus() : string;


	/**
	 * Get the original response.
	 *
	 * @return ResponseInterface
	 */
	public function getOriginalResponse() : ResponseInterface;
}
