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
     *     operationId="getSubjectById",
     *     tags={"subjects"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of subject to return",
     *         in="path",
     *         name="subjectId",
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

    /**
     * @param  Repository
     * @return Eloquent
     * @SWG\Post(
     *      path="/subjects",
     *      tags={"subjects"},
     *      operationId="addSubjects",
     *      summary="Add new subject",
     *      description="",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Subjects object that needs to be added",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Subjects"),    
     *      ),
     *      @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *      ),
     *      security={{"Bearer":{}}}
     * )
     */    
    public function store(Repository $repository)
    {
        $data = request()->validate([
            'name' => 'required|string',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
        ]);

        return new Subjects(Subject::create($data));
    }

    /**
     * @param  Repository
     * @return Eloquent
     * @SWG\Put(
     *      path="/subjects/{subjectId}",
     *      tags={"subjects"},
     *      operationId="updateSubject",
     *      summary="Update existing subject",
     *      description="",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *         description="ID of subject to return",
     *         in="path",
     *         name="subjectId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Subject object that needs to be added",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(property="name", type="string", example="Forestry"),
     *              @SWG\Property(property="created_at", type="date", example="2017-10-26"),
     *              @SWG\Property(property="updated_at", type="date", example="2017-10-27"),
     *          ),      
     *      ),
     *      @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *      ),
     *      security={{"Bearer":{}}}
     * )
     */
    public function update(Subject $subject)
    {
        $data = request()->validate([
            'name' => 'required|string',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
        ]);

        $subject->update($data);

        return new Subjects($subject);
    }
    
} 
