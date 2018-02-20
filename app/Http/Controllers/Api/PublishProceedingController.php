<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Proceedings;
use App\Proceeding;
use App\Rules\ReadyToPublish;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PublishProceedingController extends Controller
{
    /**
     * @param  Repository
     * @return Eloquent
     * @SWG\Post(
     *      path="/proceedings/publish",
     *      tags={"proceedings"},
     *      operationId="publishProceeding",
     *      summary="Publish existing proceeding",
     *      description="",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Proceeding object that needs to be added",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(property="proceeding_id", type="integer", example=3),
     *          ),      
     *      ),
     *      @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *      ),
     *      security={{"Bearer":{}}}
     * )
     */
    public function store()
    {
        $request = request()->validate([
            'proceeding_id' => [
                'required',
                'exists:proceedings,id',
                new ReadyToPublish
            ],
        ]);

        $proceeding = tap(Proceeding::find($request['proceeding_id']))->update([
            'published_at' => Carbon::now(),
        ]);

        return new Proceedings($proceeding);
    }
}
