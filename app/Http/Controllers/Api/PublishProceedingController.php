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
