<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Proceedings as ProceedingsResource;
use App\Http\Resources\ProceedingsCollection;
use App\Proceeding;
use App\Repositories\Api\ProceedingsRepository as Repository;

class ProceedingController extends Controller
{
	/**
     * @SWG\Get(
     *     path="/proceedings/",
     *     summary="Get all proceedings",
     *     description="Return collection of proceedings",
     *     operationId="getAllProceedings",
     *     tags={"proceedings"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     )
     * )
     */
    public function index(Repository $repository)
    {
        $queries = request()->validate([
            'keyword' => 'string',
            'name' => 'string',
            'alias' => 'string',
            'date' => 'string',
            'subject' => 'integer',
            'sort' => [
                'string', 
                'regex:(asc|desc)',
            ],
        ]);

    	return new ProceedingsCollection($repository->getAll($queries));
    }
    

    public function show(Proceeding $proceeding)
    {
    	return new ProceedingsResource($proceeding->load('article'));
    }

    public function store(Repository $repository)
    {
        $data = request()->validate([
            'name' => 'required|string',
            'alias' => 'string',
            'organizer' => 'required|string',
            'conference_start' => 'required|date',
            'conference_end' => 'required|date',
        ]);

        return new ProceedingsResource(Proceeding::create($data));
    }

    public function update(Proceeding $proceeding)
    {
        $data = request()->validate([
            'name' => 'required|string',
            'alias' => 'required|string',
            'organizer' => 'required|string',
            'conference_start' => 'required|date',
            'conference_end' => 'required|date',
            'introduction' => 'string|max:2500',
            'isbn' => 'integer|min:13|max:13',
            'issn' => 'integer|min:9|max:9',
        ]);

        $proceeding->update($data);

        return new ProceedingsResource($proceeding);;
    }
}
