<?php

namespace App\Auth;

use Illuminate\Auth\GenericUser;

/**
* Api User Class
*/
class ApiUser extends GenericUser
{
	/**
	 * Store API token to auth instance
	 * 
	 * @param string $token JWT api token
	 */
    public function setApiToken($token)
    {
        $this->attributes['api_token'] = 'Bearer '.$token;
    }
}