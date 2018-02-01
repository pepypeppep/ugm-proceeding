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
		$this->body = json_decode($e->getBody(), true);
	}
	
	public function render($request)
	{
		if (in_array($this->code, [400, 404, 401, 403, 500])) {
			$code = $this->code;
			return view('dashboard.layouts.error', compact('code'))->withErrors($this->body);
		} elseif ($this->code == 422) {
			return redirect()->back()->withInput()->withErrors($this->body['errors']);
		}
	}

}