<?php

namespace App\Exceptions;

/**
* API request failed exception
*/
class RequestFailed extends \Exception
{
	public $code;
	public $body;

	function __construct($e)
	{
		$this->code = $e->getStatusCode();
		$this->body = $e->getBody();
	}
	
	public function render($request)
	{
		$code = $this->code;
		$body = $this->body;

		return view('dashboard.layouts.error', compact('code'))->withErrors($body);
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