<?php

namespace App\Repositories\Traits;

/**
* Default filtering and sorting method
*/
trait DefaultFilter
{
	public function defaultFilter($field, $query)
	{
		$this->model = $this->model->where($field, $this->fields[$field], "%$query%");
	}

	public function defaultSort($field, $direction)
	{
		$this->model = $this->model->orderBy($field, $direction);
	}
}