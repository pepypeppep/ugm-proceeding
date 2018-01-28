<?php

namespace App\Repositories\Traits;

/**
* Filter for proceedings
*/
trait ProceedingFilter
{
	public function subjectFilter($field)
	{
		$this->model =  $this->model->whereHas('subject', function ($q) use ($field)
		{
			$q->where('subject_id', $field);
		});
	}

	public function statusFilter($field)
	{
		switch ($field) {
			case 'draft':
				$this->model = $this->model->whereNull('published_at');
				break;

			case 'published':
				$this->model = $this->model->whereNotNull('published_at');
				break;

			case 'trashed':
				$this->model = $this->model->onlyTrashed();
				break;
			
			default:
				# code...
				break;
		}
	}

	public function dateFilter($field)
	{
		$this->model = $this->model->where('conference_start', 'like', "%$field%");
	}

	public function keywordFilter($field)
	{
		$this->model = $this->model->where('name', 'like', "%$field%")->orWhere('alias', 'like', "%$field%");
	}
}