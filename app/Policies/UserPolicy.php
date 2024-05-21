<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    //if they are user or an admin , then they are viewadmins?
    //view admin is if they can access the panel
    public function viewAdmin(User $user) : bool{
        return $user->isAdmin() || $user->isUserMng() || $user->isContentMng() || $user->isCategoryMng();
    }

    // public function isAdmin(){
    //     return $this->role === self::ROLE_ADMIN;
    // }

    // public function isContentMng(){
    //     return $this->role === self::CONTENT_MNG;
    // }

    // public function isCategoryMng(){
    //     return $this->role === self::ROLE_CATEGORY_MNG;
    // }

    // public function isUserMng(){
    //     return $this->role === self::ROLE_USER_MNG;
    // }

    // public function isAlumini(){
    //     return $this->role === self::ROLE_ALUMINI;
    // }

    // public function isStudent(){
    //     return $this->role === self::ROLE_USER;
    // }

    /**
     * Determine whether the user can view any models.
     */

     //do we need to give the admin this much power
    public function viewAny(User $user): bool
    {
        //comment out to limit admin power
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->isAdmin()||$user->isUserMng();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //no one can create users.
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool

    {
        //admins cant update anything , plus levels and everything is in
        return $user->isAdmin();
        //only the admin can change the user roles
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->isAdmin()||$user->isUserMng();

    }
}
