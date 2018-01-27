<?php

namespace App\Exceptions;

/**
* API request failed exception
*/
class RequestFailed extends \Exception
{
	public $response;

	public $input;

	function __construct($response, $input)
	{
		$this->response = $response;
		$this->input = $input;
	}
	
	public function render($request)
	{
		$error = $this->getErrorData();
		return $error;
	}

	public function getErrorData()
	{
		$code = $this->response->getStatusCode();

		switch ($code) {
			case 404:
				return [
					'message' => 'Page not found'
				];
				break;

			case 422:
				return json_decode($this->response->getBody(), true);
				break;
			
			default:
				return 'Request errors';
				break;
		}
	}
}