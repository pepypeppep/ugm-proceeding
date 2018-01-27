<?php

namespace App\Repositories;

use App\Services\GuzzleService;

/**
* Proceedings Repository
*/
class ProceedingsRepository extends GuzzleService
{
	
	protected $uris = [
		'base' => 'proceedings',
	];

	public function getProceedings()
	{
		$this->getResponse('GET', $this->uris['base']);

		return $this;
	}
}