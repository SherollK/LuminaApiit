<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Auth\Access\Response;

class UserProfilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserProfile $userProfile): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //for everyone user profile gets created automatically 
        return false; 
    }

    /**
     * Determine whether the user can update the model.
     */

     //only you can edit your own user profile
    public function update(User $user, UserProfile $userProfile): bool
    {
        return $user->id === $userProfile->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserProfile $userProfile): bool
    {
        return false; 
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, UserProfile $userProfile): bool
    {
        return false; 
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, UserProfile $userProfile): bool
    {
        return false;
    }
}
