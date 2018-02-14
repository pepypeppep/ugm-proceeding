<?php

namespace App\Repositories;

use App\Services\GuzzleService;


class ArticlesRepository extends GuzzleService
{	
	protected $uris = [
		'base' => 'articles',
	];

	public $img = [
		'scopus' => '/img/logos/scopus-logo.png',
		'doaj' => '/img/logos/doaj-logo.png'
	];

	public function store($request)
	{
		$multipart = collect();

		collect($request)->except('authors', '_token', 'file_pdf', 'file_link')->each(function ($item, $key) use ($multipart)
		{
			$multipart->push([
				'name' => $key,
				'contents' => $item,
			]);
		});

		if ($request['file_type'] == 'pdf') {
			$multipart->push([
				'name' => 'file_pdf',
				'contents' => fopen(request()->file('file_pdf'), 'r'),
			]);
		} else {
			$multipart->push([
				'name' => 'file_link',
				'contents' => $request['file_link'],
			]);
		}

		collect($request['authors'])->each(function ($item, $index) use ($multipart)
		{
			foreach ($item as $key => $value) {
				if (!empty($value)) {
					$multipart->push([
						'name' => "authors[$index][$key]",
						'contents' => $value,
					]);
				}
			}
		});

		$this->multipart = $multipart->toArray();
		$this->getResponse('POST', $this->uris['base']);

		return $this;
	}

	public function find($id)
	{
		$this->getResponse('GET', $this->uris['base']."/$id");

		return $this;
	}

	public function update($request, $id)
	{
		$multipart = collect();

		collect($request)->except('authors', '_token', 'file_pdf', 'file_link')->each(function ($item, $key) use ($multipart)
		{
			$multipart->push([
				'name' => $key,
				'contents' => $item,
			]);
		});

		$this->multipart = $multipart->toArray();
		$this->getResponse('POST', $this->uris['base']."/$id");

		return $this;
	}
}