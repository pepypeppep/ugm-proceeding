<?php

namespace App\Repositories\Api;

use App\Proceeding;
use App\Repositories\Traits\ProceedingFilter;

/**
* Proceeding repository
*/
class ProceedingsRepository extends Repository
{
	/**
	* Use custom filter
	* Usually for realtion query that can't be specified directily on search field
	*/
	use ProceedingFilter;

	/**
	* Search field attribute
	* 
	* @var array('field' => 'query operator')
	*/
	protected $fields = [
		'keyword' => 'like',
		'name' => 'like',
		'alias' => 'like',
		'date' => 'like',
		'subject' => '=',
	];
	
	/**
	* Define the related model
	*/
	function __construct(Proceeding $model)
	{
		$this->model = $model;
	}

	public function getAll($queries = null)
	{
		return $this->filterSort($queries)->with('subject')->paginate('10')->appends(request()->except('page'));
	}

}