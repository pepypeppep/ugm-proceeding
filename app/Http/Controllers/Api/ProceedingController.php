<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Proceedings;
use App\Http\Resources\ProceedingsCollection;
use App\Proceeding;

class ProceedingController extends Controller
{
    public function index()
    {
    	return new ProceedingsCollection(Proceeding::paginate(10));
    }
    /**
     * @SWG\Get(
     *   path="/proceedings",
     *   summary="List all proceedings",
     *   operationId="getProceedings",
     *   @SWG\Parameter(
     *     name="customerId",
     *     in="path",
     *     description="Target customer.",
     *     required=false,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="filter",
     *     in="query",
     *     description="Filter results based on query string value.",
     *     required=false,
     *     enum={"active", "expired", "scheduled"},
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function show(Proceeding $proceeding)
    {
    	return new Proceedings($proceeding->load('article'));
    }
}
