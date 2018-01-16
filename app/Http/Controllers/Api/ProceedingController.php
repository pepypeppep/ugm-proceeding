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
    *         description="successful operation"
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
    
    /**
     * @SWG\Get(
     *     path="/proceedings/{proceedingsId}",
     *     summary="Find proceeding by Id",
     *     description="Returns a single proceeding with articles",
     *     operationId="getProceedingById",
     *     tags={"proceedings"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of proceeding to return",
     *         in="path",
     *         name="proceedingsId",
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
    public function show(Proceeding $proceeding)
    {
    	return new ProceedingsResource($proceeding->load('article'));
    }

    /**
     * @param  Repository
     * @return Eloquent
     * @SWG\Post(
     *      path="/proceedings",
     *      tags={"proceedings"},
     *      operationId="addProceeding",
     *      summary="Add new proceeding",
     *      description="",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Proceeding object that needs to be added",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Proceedings"),    
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
            'alias' => 'string',
            'organizer' => 'string',
            'conference_start' => 'required|date',
            'conference_end' => 'required|date',
        ]);

        return new ProceedingsResource(Proceeding::create($data));
    }

    /**
     * @param  Repository
     * @return Eloquent
     * @SWG\Put(
     *      path="/proceedings/{proceedingId}",
     *      tags={"proceedings"},
     *      operationId="updateProceeding",
     *      summary="Update existing proceeding",
     *      description="",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *         description="ID of proceeding to return",
     *         in="path",
     *         name="proceedingId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Proceeding object that needs to be added",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(property="name", type="string", example="Proceeding of International Conference on Southeast Asia 2017"),
     *              @SWG\Property(property="alias", type="string", example="ICSEAS 2017"),
     *              @SWG\Property(property="organizer", type="string", example="BPP UGM"),
     *              @SWG\Property(property="conference_start", type="date", example="2017-10-26"),
     *              @SWG\Property(property="conference_end", type="date", example="2017-10-27"),
     *              @SWG\Property(property="introduction", type="date", example="How puzzling all these changes are! I'm never sure what I'm going to shrink any further: she felt unhappy."),
     *              @SWG\Property(property="isbn", type="integer", example="9783161484100"),
     *              @SWG\Property(property="issn", type="integer", example="20149360"),
     *          ),      
     *      ),
     *      @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *      ),
     *      security={{"Bearer":{}}}
     * )
     */
    public function update(Proceeding $proceeding)
    {
        $data = request()->validate([
            'name' => 'required|string',
            'alias' => 'required|string',
            'organizer' => 'required|string',
            'conference_start' => 'required|date',
            'conference_end' => 'required|date',
            'introduction' => 'string|max:2500',
            'isbn' => 'digits:13',
            'issn' => 'digits:8',
        ]);

        $proceeding->update($data);

        return new ProceedingsResource($proceeding);
    }

    /**
     * [updateCovers description]
     * @param  Proceeding $proceeding 
     * @return              
     * @SWG\Put(
     *     path="/proceedings/{proceedingId}/updateSubjects",
     *     tags={"proceedings"},
     *     consumes={"application/json"},
     *     summary="Update proceeding subjects",
     *     description="",
     *     operationId="updateSubjects",
     *     @SWG\Parameter(
     *         description="ID of Proceeding to update",
     *         format="int64",
     *         in="path",
     *         name="proceedingId",
     *         required=true,
     *         type="integer"
     *     ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="id's of subject that need to be attached to proceeding",
     *          required=true,
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(
     *                  @SWG\Property(property="subject_id", type="integer", example=1)
     *              )
     *          ),
     *      ),
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response="200",
     *         description="successful operation",
     *     ),
     *     security={{"Bearer":{}}}
     *  )   
     */
    public function updateSubjects(Proceeding $proceeding)
    {
        $data = request()->validate([
            '*.subject_id' => 'required|int|exists:subjects,id'
        ]);

        $subjectsId = collect($data)->flatten();
        $proceeding->subject()->sync($subjectsId);

        return new ProceedingsResource($proceeding);
    }

    /**
     * [updateCovers description]
     * @param  Proceeding $proceeding 
     * @return              
     * @SWG\Post(
     *     path="/proceedings/{proceedingId}/covers",
     *     tags={"proceedings"},
     *     consumes={"multipart/form-data"},
     *     summary="Upload proceeding covers",
     *     description="",
     *     operationId="uploadCovers",
     *     @SWG\Parameter(
     *         description="ID of Proceeding to update",
     *         format="int64",
     *         in="path",
     *         name="proceedingId",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Front cover image",
     *         in="formData",
     *         name="front_cover",
     *         required=true,
     *         type="file"
     *     ),
     *     @SWG\Parameter(
     *         description="Back cover image",
     *         in="formData",
     *         name="back_cover",
     *         required=false,
     *         type="file"
     *     ),
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response="200",
     *         description="successful operation",
     *     ),
     *     security={{"Bearer":{}}}
     *  )   
     */
    public function updateCovers(Proceeding $proceeding)
    {
        $data = request()->validate([
            'front_cover' => 'required|image',
            'back_cover' => 'image',
        ]);

        collect($data)->map(function ($item, $key) use ($proceeding)
        {
            $path = request()->file($key)->store('proceedings/'.$proceeding->id);
            $proceeding->update([$key => $path]);
        });

        return new ProceedingsResource($proceeding);
    }
}
