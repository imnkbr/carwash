<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ReserveTime;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function show(User $user)
    {
        return auth()->user()->id == $user->id ;
    }

    public function edit(User $user , $user_id , $time_id)
    {
        return $user->id === $user_id;
    }

    public function delete(User $user , ReserveTime $reserveTime)
    {
        return $user->id === $reserveTime->user_id;
    }
}
