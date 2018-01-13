<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Proceedings;
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
    	return new Proceedings($proceeding->load('article'));
    }
}
