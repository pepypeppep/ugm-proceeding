<?php

namespace App\Repositories;

use App\Services\GuzzleService;

/**
* Proceedings Repository
*/
class SubjectsRepository extends GuzzleService
{
	
	protected $uris = [
		'base' => 'subjects',
	];

	public function get()
	{
		$this->getResponse('GET', $this->uris['base']);

		return $this;
	}
}