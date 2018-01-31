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

	public function get()
	{
		$this->getResponse('GET', $this->uris['base']);

		return $this;
	}

	public function find($id)
	{
		$this->getResponse('GET', $this->uris['base']."/$id");

		return $this;
	}

	public function store($json)
	{
		$this->json = $json;
		$this->getResponse('POST', $this->uris['base']);

		return $this;
	}
}