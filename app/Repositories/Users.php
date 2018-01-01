<?php

namespace App\Repositories;

use App\User;
use App\Traits\SortFilterRecords;

/**
* Users repository
*/
class Users
{
	use SortFilterRecords;
	
	protected $users;

	function __construct(User $users)
	{
		$this->users = $users;
	}

	public function getAll()
	{
		$users = $this->users->where('is_superadmin', 0);
		$records = $this->filterAndSort($users);

		return $users->paginate(10)->appends(request()->except('page'));
	}
}