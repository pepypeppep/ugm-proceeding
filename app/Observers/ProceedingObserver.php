<?php

namespace App\Observers;

use App\Identifier;
use App\Proceeding;

/**
* Proceeding Observers will listen to Eloquent Events
*/
class ProceedingObserver
{

    public function created(Proceeding $proceeding)
    {
        $identifier = new Identifier;

        $proceeding->identifiers()->attach($identifier->getIdentifierId('Proceeding'));
    }
}
