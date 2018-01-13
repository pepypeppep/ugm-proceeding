<?php 

namespace App\Repositories\Api;

use App\Repositories\Traits\DefaultFilter;

/**
* Repository abstract class
*/
class Repository
{
	use DefaultFilter;

	protected $fields = [];
	protected $model;
	protected $query = [];

	function __construct()
	{
		$this->fields = collect($fields);
	}

	public function filterSort($query)
	{
		$this->query = $query;
		$this->generateQuery()->generateSort();

		return $this->model;
	}

	public function generateQuery()
	{
		collect($this->fields)->map(function ($item, $key)
		{
			if (is_callable([$this, $key.'Filter']) && !empty($this->query[$key])) {
				$this->{$key.'Filter'}($this->query[$key]);
			} elseif (!empty($this->query[$key])) {
				$this->defaultFilter($key, $this->query[$key]);
			}
		});

		return $this;
	}

	public function generateSort()
	{
		if (!empty($this->query['sort'])) {
			$sort = explode('.', $this->query['sort']);

			if (is_callable([$this, $sort[0].'Sort'])) {
				$this->{$sort[0].'Sort'}($sort);
			} else {
				$this->defaultSort($sort[0], $sort[1]);
			}
		}

		return $this;
	}
}