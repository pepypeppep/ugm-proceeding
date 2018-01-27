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
		'title' => 'like',
		'abstract' => 'like',
		'author' => 'like',
		'date' => 'like',
	];
	
	function __construct(Article $article)
	{
		$this->model = $article;
	}

	/**
	 * Get all articles with query
	 * @param  array $queries validated query
	 * @return Collection
	 */
	public function getAll($queries = null)
	{
		return $this->filterSort($queries)->with('author')->paginate('10')->appends(request()->except('page'));
	}

	/**
	 * create new articles query
	 * @param  array $request 
	 * @return Collection          
	 */
	public function create($request)
	{
		$article = $this->model->create([
			'proceeding_id' => $request->proceeding_id,
			'abstract' => $request->abstract,
			'end_page' => $request->end_page,
			'title' => $request->title,
			'start_page' => $request->start_page,
			'keywords' => $request->keywords,
		]);

		foreach ($request->authors as $key => $value) {
			$article->author()->create([
				'name' => $value['name'],
				'affiliation' => $value['affiliation'],
				'email' => $value['email'],
			]);
		}

		if ($request->file_type == 'pdf') {
			$path = $request->file('file_pdf')->store('proceedings/'.$article->proceeding_id.'/articles');
			$article->update(['file' => $path]);
		} else {
			$article->indexation()->create([
				'type' => $request->file_type,
				'link' => $request->file_link,
			]);
		}

		if (!empty($request->doi)) {
			$article->article_identifier()->create([
				'type' => 'doi',
				'code' => $request->doi,
			]);
		}

		return $article->load('author');
	}
}