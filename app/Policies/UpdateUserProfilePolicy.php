<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class UpdateUserProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewField(User $user, string $fieldName)
    {
        // Combine category and role checks
        if ($fieldName === 'category' && $user->role === 'STAFF') {
            return true; // Allow staff to see the 'category' field
        } elseif ($fieldName === 'year' && $user->category === 'DEGREE') {
            return true; // Allow DEGREE users to see the 'year' field
        }

        $allowedFields = [
            'admin' => ['category'], // Fields visible to staff
            'editor' => ['year'], // Fields visible to degree students
        ];

        return in_array($fieldName, $allowedFields[$user->role] ?? []);
    }
}
