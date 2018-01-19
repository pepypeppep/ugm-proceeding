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
		'get_user' => 'api/user',
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

		$response = $this->getResponse('POST', $this->uris['request_token']);

		return 'Bearer '.$response->get('access_token');
	}

	public function getUser()
	{
		$query = request()->validate([
			'name' => 'string',
			'email' => 'string',
		]);
		
		$this->query = $query;

		$response = $this->getResponse('GET', $this->uris['get_user']);

		return $response;
	}
}