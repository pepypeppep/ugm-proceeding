<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

/**
* A class to simplfy Guzzle HTTP request
*/
class GuzzleService
{
	/**
	 * base url for guzzle client request
	 * @var string
	 */	
	public $base_uri;

	/**
	 * request body
	 * @var array
	 */
	protected $body;

	/**
	 * Guzzle http client
	 * @var GuzzleHttp\Client
	 */
	protected $client;

	public $form_params = [];

	/**
	 * Request headers
	 * @var array
	 */
	public $headers = [];

	/**
	 * json request that will be attach to $body
	 * @var array
	 */
	public $json = [];

	/**
	 * multipart form data request that
	 * will be attached to body
	 * @var array
	 */
	public $multipart = [];

	/**
	 * request url query
	 * @var array
	 */
	public $query = [];

	/**
	 * request response
	 * @var array
	 */
	protected $response;
	
	/**
	 * set base url and inisiate Guzzle client
	 */
	function __construct()
	{
		$this->base_uri = url('api/');

		$this->client = new Client([
			'base_uri' => $this->base_uri
		]);

		$this->headers = $this->setHeaders();
	}

	/**
	 * set body property request, get response based on method, uri parameter
	 * and body
	 * @param  string $method GET|POST|PUT|DELETE
	 * @param  string $uri
	 * @return array
	 */
	public function getResponse($method, $uri)
	{
		$this->setBody();
		$response = $this->client->request($method, $uri, $this->body)->getBody();
		$this->response = collect(json_decode($response, true));

		return $this->response;
	}

	/**
	 * set body property based on query, form_params,
	 * json, multipart, and headers property
	 */
	public function setBody()
	{
		$body = [];

		if (!empty($this->query)) {
			$body['query'] = $this->query;
		}

		if (!empty($this->form_params)) {
			$body['form_params'] = $this->form_params;
		}

		if (!empty($this->json)) {
			$body['json'] = $this->json;
		}

		if (!empty($this->multipart)) {
			$body['multipart'] = $this->multipart;
		}

		if (!empty($this->headers)) {
			$body['headers'] = $this->headers;
		}

		$this->body = $body;
		return $this;
	}

	public function setHeaders()
	{
		return [
			'Accept' => 'application/json',
			'Authorization' => session('api_token', null),
		];
	}
}