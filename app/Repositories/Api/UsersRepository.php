<?php

namespace App\Repositories\Api;

use App\User;
use App\Traits\SortFilterRecords;

/**
* Users repository
*/
class UsersRepository extends Repository
{
	/**
	* Search field
	*/
	protected $fields = [
		'name' => 'like',
		'email' => 'like',
	];

	function __construct(User $user)
	{
		$this->model = $user;
	}

	public function getAll($queries = null)
	{
		return $this->filterSort($queries)->paginate(10)->appends(request()->except('page'));
	}
}
