<?php

use App\Models\User;
use Tests\TestCase;
use App\Models\UserProfile;

class UserProfileTest extends TestCase
{
    /////////////////////////////////////////////////////////////////     USER TESTS

    /**
     * Test that a USER can access the User profile page.
     */
    public function testUserProfileScreenCanBeRendered(): void
    {
        $user = User::factory()->create(); //create user
        $userProfile = UserProfile::factory()->make([
            'user_id' => $user->id, // Use the generated user ID
            'bio' => 'This is a sample bio.',
            'verifedStatus'=>'NONE',
        ]);

        $user->save(); //save user in database
        $userProfile->save();

        $response = $this->actingAs($user)->get('/user-profile/'.$user->id);
        $response->assertStatus(200);

        $userProfile->delete();
        $user->delete(); //clean up user

    }

    /**
     * Test that a USER can access the Another users User profile page.
     */
    public function testOtherUserProfilesCanBeRendered(): void
    {
        $user0 = User::factory()->create();
        $user = User::factory()->create(); //create user
        $userProfile = UserProfile::factory()->make([
            'user_id' => $user->id, // Use the generated user ID
            'bio' => 'This is a sample bio.',
            'verifedStatus'=>'NONE',
        ]);

        $user0->save();
        $user->save(); //save user in database
        $userProfile->save();

        $response = $this->actingAs($user0)->get('/user-profile/'.$user->id);
        $response->assertStatus(200);

        $userProfile->delete();
        $user->delete();
        $user0->delete();//clean up user

    }

    /////////////////////////////////////////////////////////////////     ADMIN TESTS

    /**
     * Test that a ADMIN can access anyones profile page.
     */
    public function testAdminCanAccessEventPage()
    {
        $userAdmin = User::factory()->create([
            'role' => 'ADMIN', //setting role to ADMIN
        ]);
        $user = User::factory()->create(); //create user
        $userProfile = UserProfile::factory()->make([
            'user_id' => $user->id, // Use the generated user ID
            'bio' => 'This is a sample bio.',
            'verifedStatus'=>'NONE',
        ]);

        $user->save();
        $userAdmin->save();
        $userProfile->save();

        $response = $this->actingAs($userAdmin)->get('/user-profile/'.$user->id);
        $response->assertStatus(200);

        $userProfile->delete();
        $user->delete();
        $userAdmin->delete();//clean up user
    }
}
