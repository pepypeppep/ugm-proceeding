<?php

namespace App\Repositories\Traits;

/**
*  Has Update Identifier Trait
*/
trait HasUpdateIdentifier
{
    /**
     * Update identidfiers
     * @param  array $identifiers [
     * ['type' => 'string', 'code' => 'string'],
     * ['type' => 'string', 'code' => 'string']
     * ]
     * @return array
     */
    public function updateIdentifiers($identifiers)
    {
        foreach ($identifiers as $item) {
            $identifier = $this->getIdentifierIdByType($item['type']);

            $this->model->identifiers()->updateExistingPivot($identifier, [
                'code' => $item['code'],
            ]);
        }

        return $this->model->identifiers;
    }

    /**
     * Get identifier id
     * @param  string $type
     * @return integer
     */
    public function getIdentifierIdByType($type)
    {
        return \App\Identifier::where('type', $type)->first()->id;
    }
}
