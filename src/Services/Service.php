<?php

namespace Juanparati\PowerBI\Services;


use Juanparati\PowerBI\Client;


/**
 * Class Service.
 *
 * @package Juanparati\PowerBI\Services
 */
abstract class Service
{


	/**
	 * The SDK client
	 *
	 * @var Client
	 */
	protected $client;


	/**
	 * Service constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

}
