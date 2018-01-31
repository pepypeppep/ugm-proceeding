<?php

namespace App\Repositories\Api;

use App\Institution;
use App\Repositories\Traits\ProceedingFilter;

/**
* Institution repository
*/
class InstitutionsRepository extends Repository
{
	/**
	* Search field
	*/
	protected $fields = [
		'name' => 'like',
	];

	function __construct(Institution $institution)
	{
		$this->model = $institution;
	}

	public function getAll($queries = null)
	{
		return $this->filterSort($queries)->paginate('10')->appends(request()->except('page'));
	} 

}