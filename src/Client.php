<?php

namespace Juanparati\PowerBI;

use GuzzleHttp\Client as httpClient;


/**
 * Class Client.
 *
 * @package Juanparati\PowerBI
 */
class Client
{

	/**
	 * Available API methods.
	 */
	const METHOD_GET 	= 'GET'	  ;
	const METHOD_POST 	= 'POST'  ;
	const METHOD_DELETE = 'DELETE';
	const METHOD_PATCH 	= 'PATCH' ;


	/**
	 * A valid access token
	 *
	 * @var string
	 */
	private $token;


	/**
	 * A Guzzle HTTP client
	 *
	 * @var HTTPClient
	 */
	protected $http_client;


	/**
	 * Client constructor.
	 *
	 * @param string     $token       An Azure AD OAuth token.
	 * @param HTTPClient $http_client A Guzzle HTTP client
	 */
	public function __construct($token, HTTPClient $http_client = null)
	{
		$this->token = $token;

		if (!$http_client)
			$http_client = new HTTPClient();

		$this->http_client = $http_client;
	}


	/**
	 * Get the access token
	 *
	 * @return string
	 */
	protected function getToken()
	{
		return $this->token;
	}


	/**
	 * Executes a HTTP request using the Guzzle HTTP client
	 *
	 * @param string $method The HTTP method to use for the request.
	 * @param string $url The URL to make the request to.
	 * @param mixed|null $body The body of the request.
	 *
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function request($method, $url, $body = null)
	{
		// Default Options
		$requestOptions = [
			'headers' => [
				"Accept"        => "application/json",
				"Authorization" => sprintf("Bearer %s", $this->getToken()),
			]
		];

		// Add body if one was provided.
		if ($body)
			$requestOptions[\GuzzleHttp\RequestOptions::JSON] = $body;

		return $this->http_client->request($method, $url, $requestOptions);
	}

}
