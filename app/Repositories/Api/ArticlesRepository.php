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

	public function create($request)
	{
		$articles = collect([]);

		foreach ($request->title as $key => $value) {
			$article = $this->model->create([
				'proceeding_id' => $request->proceeding_id,
				'abstract' => $request->abstract[$key],
				'end_page' => $request->end_page[$key],
				'title' => $request->title[$key],
				'start_page' => $request->start_page[$key],
				'keywords' => $request->keywords[$key],
			]);

			foreach ($request->author_name[$key] as $key2 => $value2) {
				$article->author()->create([
					'name' => $request->author_name[$key][$key2],
					'affiliation' => $request->author_affiliation[$key][$key2],
					'email' => $request->author_email[$key][$key2],
				]);
			}

			if ($request->file_type[$key] == 'pdf') {
				$path = $request->file('file_pdf')[$key]->store('proceedings/'.$article->proceeding_id.'/articles');
				$article->update(['file' => $path]);
			}

			if (!empty($request->doi[$key])) {
				$article->article_identifier()->create([
					'type' => 'doi',
					'code' => $request->doi[$key],
				]);
			}

			$articles->push($article->load('author'));
		}

		return $articles;
	}
}