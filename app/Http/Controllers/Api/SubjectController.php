<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Subjects;
use App\Http\Resources\SubjectsCollection;
use App\Subject;
use App\Repositories\Api\SubjectsRepository as Repository;

class SubjectController extends Controller
{
    /**
    * @SWG\Get(
    *     path="/subjects/",
    *     summary="Get all subjects",
    *     description="Return collection of subjects",
    *     operationId="getAllSubjects",
    *     tags={"subjects"},
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

    	return new SubjectsCollection($repository->getAll($queries));
    }

    /**
     * @SWG\Get(
     *     path="/subjects/{subjectsId}",
     *     summary="Find subject by Id",
     *     description="Returns a single subject",
     *     operationId="getProceedingById",
     *     tags={"subjects"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of subject to return",
     *         in="path",
     *         name="subjectsId",
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
    public function show(Subject $subject)
    { 
        return new Subjects($subject);
    }

    
    public function store(Repository $repository)
    {
        $data = request()->validate([
            'name' => 'required|string',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
        ]);

        return new Subjects(Subject::create($data));
    }
    
} 
