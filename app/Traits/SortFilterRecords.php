<?php

namespace App\Traits;

/*
* This trait recieve collection then sort/filter it based on request queries
*/
trait SortFilterRecords
{
	public function filterAndSort($instance)
	{
		$query = request()->validate([
			'keyword' => 'string',
			'sort' => [
				'string', 
				'regex:(asc|desc)',
			],
		]);

		if (!empty($query['keyword'])) {
			$instance = $instance->where('name', 'like', "%$query[keyword]%")->orWhere('email', 'like', "%$query[keyword]%");
		}

		if (!empty($query['sort'])) {
			$sort = explode('.', $query['sort']);

			$instance = $instance->orderBy($sort[0], $sort[1]);
		}

		return $instance;

	}

	public function sortInstance($instance)
	{
		$query = request()->validate([
			'sort' => [
				'string', 
				'regex:(asc|desc)',
			],
		]);

		if (!empty($query['sort'])) {
			$sort = explode('.', $query['sort']);

			$instance = $instance->orderBy($sort[0], $sort[1]);
		}

		return $instance;
	}

	public function sortCollection($collection)
	{
		return $collection;
	}
}