<?php

namespace App\Repositories\Api;

use App\Article;
use App\Repositories\Traits\ArticleFilter;

/**
* Articles repository
*/
class ArticlesRepository extends Repository
{
	use ArticleFilter;

	protected $fields = [
		'keyword' => 'like',
		'keywords' => 'like',
		'title' => 'like',
		'abstract' => 'like',
		'authors' => 'like',
		'date' => 'like',
	];
	
	function __construct(Article $article)
	{
		$this->model = $article;
	}

	public function getAll($queries = null)
	{
		return $this->filterSort($queries)->with('author')->paginate('10')->appends(request()->except('page'));
	}
}