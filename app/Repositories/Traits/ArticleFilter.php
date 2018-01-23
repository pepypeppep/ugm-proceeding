<?php

namespace App\Repositories\Traits;

/**
* Articles custom filter
*/
trait ArticleFilter
{
	
	public function keywordFilter($query)
	{
		$this->model = $this->model->where('title', 'like', "%$query%")->orWhere('abstract', 'like', "%$query%")->orWhere('keywords', 'like', "%$query%");
	}

	public function authorsFilter($query)
	{
		$this->model = $this->model->whereHas('author', function ($q) use ($query)
		{
			$q->where('name', 'like', "%$query%");
		});
	}
}