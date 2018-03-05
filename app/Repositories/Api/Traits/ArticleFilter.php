<?php

namespace App\Repositories\Api\Traits;

/**
* Articles custom filter
*/
trait ArticleFilter
{
	
	public function keywordFilter($query)
	{
		$this->model = $this->model->where('title', 'like', "%$query%")->orWhere('abstract', 'like', "%$query%")->orWhere('keywords', 'like', "%$query%");
	}

	public function authorFilter($query)
	{
		$this->model = $this->model->whereHas('author', function ($q) use ($query)
		{
			$q->where('name', 'like', "%$query%");
		});
	}
}
