<?php

namespace App\Services;

use App\Exceptions\RequestFailed;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
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

	/**
	 * request form parameters that will be
	 * attached to body
	 * @var array
	 */
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
	public $response;

	/**
	 * response data
	 * @var collection
	 */
	public $data;

	/**
	 * response metadata
	 * @var collection
	 */
	public $meta;

	/**
	 * Pagination response links
	 * @var [type]
	 */
	public $links;
	
	/**
	 * set base url and inisiate Guzzle client
	 */
	function __construct()
	{
		$this->base_uri = config('app.url').'api/';

		$this->client = new Client([
			'base_uri' => $this->base_uri
		]);
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

		// Make a request. Throw the RequestFailed exception if failed
		try {
			$request = $this->client->request($method, $uri, $this->body);
		} catch (ClientException $e) {
			throw new RequestFailed($e);
		}

		// Get response body if success
		$response = $request->getBody();
		$this->response = collect(json_decode($response, true));

		// Set data, meta, and links property
		$this->setResponseData()->setResponseMeta()->setResponselinks();

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

		$body['headers'] = $this->setHeaders();

		$this->body = $body;
		return $this;
	}

	/**
	 * Set request header. Add api token if 
	 * user is autenthicated
	 */
	public function setHeaders()
	{
		return [
			'Accept' => 'application/json',
			'Authorization' => session('api_token', null),
		];
	}

	/**
	 * set response data property
	 * if API body doesn't have data, set response as data instead
	 */
	protected function setResponseData()
	{
		if (!empty($this->response['data'])) {
			$this->data = collect($this->response['data']);
		} else {
			$this->data = collect($this->response);
		}

		return $this;
	}

	/**
	 * set response metadata
	 */
	protected function setResponseMeta()
	{
		if (!empty($this->response['meta'])) {
			$this->meta = collect($this->response['meta']);
		} else {
			$this->meta = [];
		}

		return $this;
	}

	/**
	 * set response links
	 */
	protected function setResponselinks()
	{
		if (!empty($this->response['links'])) {
			$this->links = collect($this->response['links']);
		} else {
			$this->links = [];
		}

		return $this;
	}

	public function page($page)
	{
		return url()->current().'?'.http_build_query(request()->merge(['page' => $page])->all());
	}

	public function nextPage()
	{
		return $this->page($this->meta['current_page']+1);
	}

	public function previousPage()
	{
		return $this->page($this->meta['current_page']-1);
	}

	/**
	 * Dynamically access the data's attributes.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function __get($key)
	{
		if (is_array($this->data[$key])) {
			return collect($this->data[$key]);
		}

	    return $this->data[$key];
	}
}