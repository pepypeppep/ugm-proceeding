<?php

namespace App\Repositories;

use App\Repositories\Traits\HasIdentifiers;
use App\Services\GuzzleService;

/**
* Proceedings Repository
*/
class ProceedingsRepository extends GuzzleService
{
    use HasIdentifiers;
	
	protected $uris = [
		'base' => 'proceedings',
	];

	public function get()
	{
		$this->query = [
		    'keyword' => request('keyword'),
		    'page' => request('page'),
		    'status' => request('tab'),
		    'subject' => request('subject'),
		    'sort' => request('sort') ?: 'updated_at.desc',
		];

		$this->getResponse('GET', $this->uris['base']);

		return $this;
	}

	public function find($id)
	{ 
		$this->getResponse('GET', $this->uris['base']."/$id");

        $keyword = request('keyword');

        if (!empty($keyword)){
            $this->articles = $this->articles->filter(function ($item) use ($keyword){
                $title = stristr($item['title'], $keyword);
                $authors = collect($item['authors'])->search(function ($item) use ($keyword){
                    return stristr($item['name'], $keyword);
                }) !== false;

                return $title || $authors; 
            });
        } else{
            $this->articles = $this->articles;
        }

        $sort = explode('.' , request('sort'));
        if (!request()->has('sort')) {
        	$sort = ['title','asc'];
        }
        switch ($sort[1]) {
        	case 'desc':
        		$this->articles =  $this->articles->sortByDesc($sort[0]);
        		break;
        	case 'asc':
        		$this->articles =  $this->articles->sortBy($sort[0]);
        		break;
        }

		return $this;
	}

	public function store($json)
	{
		$this->json = $json;
		$this->getResponse('POST', $this->uris['base']);

		return $this;
	}

	public function update($json, $id)
	{
		$this->json = $json;
		$this->getResponse('PUT', $this->uris['base']."/$id");

		return $this;
	}

	public function updateSubjects($params, $id)
	{
		$this->form_params = $params;
		$this->getResponse('PUT', $this->uris['base']."/$id/subjects");

		return $this;
	}

	public function updateCover($file, $id)
	{
		$this->multipart = [
			[
				'name' => 'front_cover',
				'contents' => fopen($file, 'r')
			],
		];
		$this->getResponse('POST', $this->uris['base']."/$id/covers");

		return $this;
	}

    public function publish($json)
    {
        $this->json = $json;

        $this->getResponse('POST', $this->uris['base']."/publish");

        return $this;
    }

    /*CUSTOM METHOD*/

    public function getStatusColor($status)
    {
        if ($status === 'published') {
            return 'primary';
        }

        return 'secondary';
    }

    public function readyToPublish($proceeding)
    {
        $checkLists = collect([
            !empty($proceeding->data['introduction']),
            $this->checkIdentifiers($proceeding->identifiers),
            $proceeding->subjects->isNotEmpty(),
            !empty($proceeding->data['front_cover']),
            $proceeding->articles->isNotEmpty(),
        ]);

        return $checkLists->search(false) === false;
    }

    public function checkIdentifiers($identifiers)
    {
        $status = $identifiers->map(function ($item)
        {
            return !empty($item['code']);
        });

        return $status->search(true) !== false;
    }

}
