<?php

namespace App\Repositories;

use App\Services\GuzzleService;

/**
* User repository
*/
class UsersRepository extends GuzzleService
{
	/**
	 * Define base uris here
	 * avoid to directly specify the uri on the method
	 * @var array
	 */
	protected $uris = [
		'request_token' => '/oauth/token',
		'base' => 'user',
	];

	/**
	 * get access token
	 * @return string Bearer token
	 */
	public function getToken()
	{	
		// Specify the forms parameter
		$this->form_params = [
	        'grant_type' => 'password',
	        'client_id' => env('API_CLIENT_ID', false),
	        'client_secret' => env('API_CLIENT_SECRET', false),
	        'username' => request('email'),
	        'password' => request('password'),
	        'scope' => '*',
		];

		// Make request to API endpoint and get the response
		$this->getResponse('POST', $this->uris['request_token']);

		return 'Bearer '.$this->data->get('access_token');
	}

	/**
	 * get collection of users
	 * @return Collection 
	 */
	public function get()
	{
		$query = request()->validate([
			'name' => 'string',
			'email' => 'string',
		]);
		
		$this->query = $query;

		$this->getResponse('GET', $this->uris['base']);

		return $this;
	}

	public function find($id)
	{
		$this->getResponse('GET', $this->uris['base']."/$id");

		return $this;
	}
}
