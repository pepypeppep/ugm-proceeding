<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Proceedings;
use App\Http\Resources\ProceedingsCollection;
use App\Proceeding;
use App\Repositories\Api\ProceedingsRepo;

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
    public function index()
    {
    	return new ProceedingsCollection(Proceeding::paginate(10));
    }
    

    public function show(Proceeding $proceeding)
    {
    	return new Proceedings($proceeding->load('article'));
    }

    public function query(ProceedingsRepo $repo)
    {
        $request = request()->validate([
            'name' => 'string',
            'alias' => 'string',
            'date' => 'string',
            'subject' => 'integer',
            'sort' => [
                'string', 
                'regex:(asc|desc)',
            ],
        ]);

        return $repo->getAll($request);
    }
}
