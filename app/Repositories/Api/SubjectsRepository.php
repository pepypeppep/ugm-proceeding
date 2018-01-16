<?php

namespace App\Repositories\Api;

use App\Subject;
use App\Repositories\Traits\ProceedingFilter;

/**
* Subject repository
*/
class SubjectsRepository extends Repository
{
	/**
	* Search field
	*/
	protected $fields = [
		'name' => 'like',
	];

	function __construct(Subject $subject)
	{
		$this->model = $subject;
	}

	public function getAll($queries = null)
	{
		return $this->filterSort($queries)->get();
	} 

}