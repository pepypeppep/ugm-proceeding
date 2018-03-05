<?php 

namespace App\Repositories\Api;

use App\Repositories\Traits\DefaultFilter;

/**
* Repository abstract class
*/
class Repository
{
	/**
	* Default filter and sorting method
	*/
	use DefaultFilter;

	/**
	* Filter and search field
	*/
	protected $fields = [];

	/**
	* Repository's related model
	*/
	protected $model;

	/**
	* Search query
	*/
	protected $query = [];

	function __construct()
	{
		$this->fields = collect($fields);
	}

	public function setModel($model, $property = 'model')
	{
		$this->$property = $model;

		return $this;
	}

	public function filterSort($query)
	{
		$this->query = $query;
		$this->generateFilters()->generateSorts();

		return $this->model;
	}

	public function generateFilters()
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

	public function generateSorts()
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
