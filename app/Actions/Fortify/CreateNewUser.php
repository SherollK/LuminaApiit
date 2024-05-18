<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $selectedRole = $input['role']; 
        if ($selectedRole === 'ROLE_ALUMINI') {
            $role = User::ROLE_ALUMNI;
        } elseif ($selectedRole === 'current student') {
            $role = User::ROLE_USER;
        } else {
            $role = User::ROLE_OTHER;
        }


        

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $selectedRole
            
        ]) ;

        $graduation_year = $input['graduatingYear']; 
        $location = $input['location']; 
        $level = $input['level']; 



      

        $userProfile = new UserProfile();
        $userProfile->user_id = $user->id; 
        $userProfile->location = $location ;
        $userProfile->level = $level;
        $userProfile->graduationYear = $graduation_year;
        $userProfile->jobDescription = $input['job_description'];
        $userProfile->bio = $input['bio'];

        //there;s a typo in the database fix it later. till then keep it like
        $userProfile->verifedStatus = 'NONE';
        $userProfile->save();



        //attacing the categoires to the user table.
        if (isset($input['categories'])) {
            $user->categories()->attach($input['categories']);
        }


        return $user;










        

        
        
    }
}
