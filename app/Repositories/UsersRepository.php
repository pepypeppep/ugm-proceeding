<?php

namespace App\Repositories;

use App\Services\GuzzleService;

/**
* User repository
*/
class UsersRepository extends GuzzleService
{
	protected $uris = [
		'request_token' => '/oauth/token',
		'base' => 'user',
	];

	public function getToken()
	{
		$this->form_params = [
	        'grant_type' => 'password',
	        'client_id' => env('API_CLIENT_ID', false),
	        'client_secret' => env('API_CLIENT_SECRET', false),
	        'username' => request('email'),
	        'password' => request('password'),
	        'scope' => '*',
		];

		$this->getResponse('POST', $this->uris['request_token']);

		return 'Bearer '.$this->response->get('access_token');
	}

	public function getUser()
	{
		$query = request()->validate([
			'name' => 'string',
			'email' => 'string',
		]);
		
		$this->query = $query;

		$this->getResponse('GET', $this->uris['base']);

		return $this;
	}

	public function findUser($id)
	{
		$this->getResponse('GET', $this->uris['base']."/$id");

		return $this;
	}
}