<?php

namespace App\Repositories\Api;

use App\Identifier;
use App\Proceeding;
use App\Repositories\Api\Traits\HasUpdateIdentifier;
use App\Repositories\Api\Traits\ProceedingFilter;

/**
* Proceeding repository
*/
class ProceedingsRepository extends Repository
{
	/**
	* Use custom filter
	* Usually for realtion query that can't be specified directily on search field
	*/
	use ProceedingFilter, HasUpdateIdentifier;

	/**
	* Search field attribute
	* 
	* @var array('field' => 'query operator')
	*/
	protected $fields = [
		'alias' => 'like',
		'date' => 'like',
		'keyword' => 'like',
		'name' => 'like',
		'status' => 'like',
		'subject' => '=',
	];
	
	/**
	* Define the related model
	*/
	function __construct(Proceeding $model)
	{
		$this->model = $model;
	}

	public function getAll($queries = null)
	{
		return $this->filterSort($queries)->with('subject')->paginate('10')->appends(request()->except('page'));
	}

	/**
	 * Update proceeding data
	 * @param  Illuminate\Http\Request $request
	 * @param  App\Proceeding $proceeding
	 * @return Bool
	 */
	public function update($request, $proceeding)
	{
		$this->setModel($proceeding);
		$this->updateIdentifiers($request['identifiers']);
		$this->updateData($request->except('identifiers')->all());

		return $this->model;
	}

	public function updateData($data)
	{
		return $this->model->update($data);
	}

}
