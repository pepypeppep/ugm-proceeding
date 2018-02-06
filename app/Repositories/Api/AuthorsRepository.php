<?php

namespace App\Repositories\Api;

use App\Author;

/**
* Institution repository
*/
class AuthorsRepository extends Repository
{
	/**
	* Search field
	*/
	protected $fields = [
		'name' => 'like',
	];

	function __construct(Author $author)
	{
		$this->model = $author;
	}

	public function getAll($queries = null)
	{
		return $this->filterSort($queries)->get()->unique('name')->values();
	} 

}