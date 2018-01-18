<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Services\GuzzleService;
use Illuminate\Support\Facades\Hash;

/**
* Api User Provider
*/
class ApiUserProvider implements UserProvider
{
	
	function __construct()
	{
		# code...
	}

	/**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
    	$user = $this->getUserById($identifier);

    	return $this->getApiUser($user);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed   $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
    	return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {

    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
    	$user = $this->getUserByCredential($credentials['email']);

    	return $this->getApiUser($user);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
    	// return $user->getAuthPassword() == $credentials['password'];
    	return Hash::check($credentials['password'], $user->getAuthPassword());
    }

    protected function getUsers()
    {
    	$client = new GuzzleService;
    	$client->headers['Authorization'] = env('API_TOKEN', false);
    	$response = $client->getResponse('GET', 'api/auth-users');

    	return collect($response['data']);
    }

    protected function getApiUser($user)
    {
    	if (!empty($user)) {
    		return new ApiUser($user);
    	}
    }

    protected function getUserByCredential($email)
    {
    	$user = $this->getUsers()->where('email', $email)->first();

    	return $user ?: null;
    }

    protected function getUserById($id)
    {
    	$user = $this->getUsers()->where('id', $id)->first();

    	return $user ?: null;
    }

}