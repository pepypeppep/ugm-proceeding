<?php

namespace App\Repositories\Traits;

/**
* Has Identifiers Trait
*/
trait HasIdentifiers
{
    public function getIdentifierName($type)
    {
        $name = explode("_", $type);

        if (count($name) == 1) {
            return strtoupper($name[0]);
        }

        return ucfirst($name[0]).' '.strtoupper($name[1]);
    }
}
