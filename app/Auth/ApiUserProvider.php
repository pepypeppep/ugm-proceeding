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

    /**
     * get user form api
     * @param  array $params email or id user
     * @return array
     */
    public function getUsers($params)
    {
    	$client = new GuzzleService;

        $client->form_params = $params;

    	$response = $client->getResponse('POST', 'api/find-user');

    	return $response['data'];
    }

    /**
     * Get new user Authenticatable instance        
     * @param  array $user
     * @return Authenticatable
     */
    protected function getApiUser($user)
    {
    	if (!empty($user)) {
    		return new ApiUser($user);
    	}
    }

    /**
     * find user by email from API
     * @param  string $email 
     * @return array
     */
    protected function getUserByCredential($email)
    {
        $params = ['email' => $email];
    	$user = $this->getUsers($params);

    	return $user ?: null;
    }

    /**
     * find user by id from API
     * @param  integer $id 
     * @return array
     */
    protected function getUserById($id)
    {
        $params = ['id' => $id];
    	$user = $this->getUsers($params);

    	return $user ?: null;
    }

    protected function getUserByToken($id, $token)
    {
        $params = [
            'remember_token' => $token,
            'id' => $id,
        ];
        $user = $this->getUsers($params);

        return $user ?: null;
    }

}