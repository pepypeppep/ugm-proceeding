<?php

namespace App\Repositories;

use App\Services\GuzzleService;


class ArticlesRepository extends GuzzleService
{	
	protected $uris = [
		'base' => 'articles',
	];

	public function store()
	{
		$multipart = collect();

		collect(request()->all())->except('authors', '_token')->each(function ($item, $key) use ($multipart)
		{
			$multipart->push([
				'name' => $key,
				'content' => $item,
			]);
		});

		collect(request('authors'))->each(function ($item, $index) use ($multipart)
		{
			foreach ($item as $key => $value) {
				$multipart->push([
					'name' => "authors[$key][$index]",
					'content' => $value,
				]);
			}
		});

		return $multipart;
	}
}