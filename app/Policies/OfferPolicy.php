<?php

namespace App\Policies;

use App\User;
use App\OfferLetter;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;
     public function viewAny(User $user)
     {
        return $user->isAdmin();
     }
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
