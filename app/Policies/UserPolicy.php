<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
     public function viewAny(User $user)
    {
       return $user->isAdmin();

    }

    public function update(User $user)
    {
        return $user->isAdmin();
    }
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    
    
}
