<?php

namespace App\Repositories;

use App\Services\GuzzleService;

/**
* Proceedings Repository
*/
class ProceedingsRepository extends GuzzleService
{
	
	protected $uris = [
		'base' => 'proceedings',
	];

	public function get()
	{
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
}