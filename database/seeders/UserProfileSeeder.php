<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = User::take(300)->get();

        foreach ($records as $record) {
        $record->delete();

        User::all()->each(function ($user) {
            $profile = $user->profile;
            $verifiedStatus = $profile ? $profile->getIsVerifiedStatus() : null;
        
            UserProfile::factory()->create([
                'user_id' => $user->id,
                'bio' => 'Lorem ipsum dolor sit amet',
                'location' => 'New York',
                'jobDescription' => 'Software Developer',
                'graduationYear' => rand(2010, 2026),
                'verifiedStatus' => $verifiedStatus,

                'user_id',
                'bio',
                'role',
                'level', //if its student
                'location', //non nullable
                'status',
                'jobDescription',
                'graduation_year',
            ]);
        });
        
}

        //
    }
}
