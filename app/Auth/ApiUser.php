<?php

namespace App\Auth;

use Illuminate\Auth\GenericUser;

/**
* Api User Class
*/
class ApiUser extends GenericUser
{
	/**
	 * Get the "remember me" token value.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
	    return null;
	}
}