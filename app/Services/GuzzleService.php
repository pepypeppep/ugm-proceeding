<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
* A class to simplfy Guzzle HTTP request
*/
class GuzzleService
{
	protected $body;

	protected $client;

	protected $response;

	public $base_uri;

	protected $uri;

	protected $method;

	public $multipart = [];

	public $headers = [
		'Accept' => 'application/json',
		'Authorization' => '',
	];

	public $json = [];

	public $form_params = [];

	public $query = [];
	
	function __construct()
	{
		$this->base_uri = url('api/');
		$this->client = new Client([
			'base_uri' => $this->base_uri
		]);
	}

	public function getResponse($method, $uri)
	{
		$this->setBody();
		$responses = $this->client->request($method, $uri, $this->body)->getBody();
		$this->response = collect(json_decode($responses, true));

		return $this->response;
	}

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
}