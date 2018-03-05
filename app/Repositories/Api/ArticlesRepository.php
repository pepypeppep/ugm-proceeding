<?php

namespace App\Repositories\Api;

use App\Article;
use App\Repositories\Traits\ArticleFilter;
use App\Repositories\Traits\HasUpdateIdentifier;

/**
* Articles repository
*/
class ArticlesRepository extends Repository
{
	use ArticleFilter, HasUpdateIdentifier;

	protected $fields = [
		'keyword' => 'like',
		'title' => 'like',
		'abstract' => 'like',
		'author' => 'like',
		'date' => 'like',
	];
	
	function __construct(Article $article)
	{
		$this->setModel($article);
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
		// Create new article instance
		$article = $this->model->create([
			'proceeding_id' => $request->proceeding_id,
			'abstract' => $request->abstract,
			'end_page' => $request->end_page,
			'title' => $request->title,
			'start_page' => $request->start_page,
			'keywords' => $request->keywords,
			'downloads' => 0,
			'views' => 0,
		]);

		// add authors
		foreach ($request->authors as $key => $value) {
			$article->author()->create([
				'name' => $value['name'],
				'affiliation' => $value['affiliation'],
				'email' => optional($value)['email'],
			]);
		}

		// upload file if article is not indexed 
		// or create indexation if article is indexed
		if ($request->file_type == 'pdf') {
			$article->uploadAndUpdateFile($request->file('file_pdf'));
		} else {
			$article->indexation()->create([
				'type' => $request->file_type,
				'link' => $request->file_link,
			]);
		}

		$this->setModel($article);

		// create identifiers based on doi
		if (!empty($request->doi)) {
			$identifiers = array([
				'type' => 'doi',
				'code' => $request->doi,
			]);

			$this->updateIdentifiers($identifiers);
		}

		return $article->load('author');
	}

	public function update($article, $request)
	{
		$request = collect($request);

		$article->update($request->except('doi')->all());

		$article->article_identifier()->first()->update([
			'type' => 'doi',
			'code' => $request['doi'],
		]);

		return $article;
	}

	/**
	 * Update indexation on existing Article
	 * @param  Eloquent $article
	 * @param  Request $request
	 * @return boolean
	 */
	public function updateIndexation($article, $request)
	{
		if ($request->file_type == 'pdf') {
			$article->removeOldFile();
			$article->uploadAndUpdateFile($request->file('file_pdf'));

			$article->indexation->delete();
		} else {
			$article->indexation()->create([
				'type' => $request->file_type,
				'link' => $request->file_link,
			]);

			$article->update(['file' => null]);
		}
		
		return true;
	}
}
