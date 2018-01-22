<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Institutions;
use App\Http\Resources\InstitutionsCollection;
use App\Institution;
use App\Repositories\Api\InstitutionsRepository as Repository;

class InstitutionController extends Controller
{
	/**
    * @SWG\Get(
    *     path="/institutions/",
    *     summary="Get all institutions",
    *     description="Return collection of institutions",
    *     operationId="getAllInstitutions",
    *     tags={"institutions"},
    *     produces={"application/json"},
    *     @SWG\Response(
    *         response=200,
    *         description="successful operation"
    *     )
    * )
    */
    public function index(Repository $repository)
    {
    	$queries = request()->validate([
            'name' => 'string',
        ]);

    	return new InstitutionsCollection($repository->getAll($queries));
    }

    /**
     * @SWG\Get(
     *     path="/institutions/{institutionsId}",
     *     summary="Find institution by Id",
     *     description="Returns a single institution",
     *     operationId="getInstitutionById",
     *     tags={"institutions"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of institution to return",
     *         in="path",
     *         name="institutionsId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Proceeding not found"
     *     )
     * )
     */
    public function show(Institution $institution)
    { 
        return new Institutions($institution);
    }
}
