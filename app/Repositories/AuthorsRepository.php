<?php

namespace App\Repositories;

use App\Services\GuzzleService;

/**
* Proceedings Repository
*/
class AuthorsRepository extends GuzzleService
{
	
	protected $uris = [
		'base' => 'authors',
	];

	public function get()
	{
		$this->query = [
			'name' => request('name'),
		];

		$this->getResponse('GET', $this->uris['base']);

		return $this;
	}

	public function find($id)
	{
		$this->getResponse('GET', $this->uris['base']."/$id");

		return $this;
	}
}