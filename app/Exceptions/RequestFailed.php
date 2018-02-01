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

}