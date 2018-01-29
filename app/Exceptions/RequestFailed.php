<?php

namespace App\Exceptions;

/**
* API request failed exception
*/
class RequestFailed extends \Exception
{
	public $e;

	function __construct($e)
	{
		$this->e = $e;
	}
	
	public function render($request)
	{
		// $error = $this->getErrorData();
		
		return view('dashboard.layouts.error');
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