<?php

namespace App\Repositories\Api;

use App\Proceeding;
use App\Repositories\Traits\ProceedingFilter;

/**
* Proceeding repository
*/
class ProceedingsRepo extends Repository
{
	use ProceedingFilter;
	/*
	* Specify field of search here
	*/
	protected $fields = [
		'name' => 'like',
		'alias' => 'like',
		'date' => 'like',
		'subject' => '=',
	];
	
	function __construct()
	{
		$this->model = new Proceeding;
	}

	public function getAll($query)
	{
		return $this->filterSort($query)->with('subject')->get();
	}
}