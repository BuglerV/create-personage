<?php

namespace App\Policies;

use App\Models\Profession;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WarcraftGroupPolicy
{
    use HandlesAuthorization;
	
	/**
	 * Perform pre-authorization checks.
	 *
	 * @param  \App\Models\User  $user
	 * @param  string  $ability
	 * @return void|bool
	 */
	public function before(User $user, $ability)
	{
		if ($user->can('admin')) {
			return true;
		}
	}
	
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     */
    public function deny(User $user)
    {
        return false;
    }
}
