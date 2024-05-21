<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\UserProfile;
use App\Models\User;


class UserprofilePage extends Component
{

    // public $bio = ""; 
    public $userProfile;
    public $userId;
    public $likesCount; 
    public $commentsCount; 
    public $postsCount; 

 

    public function mount($userId)
    {

        $this->userId = $userId;
        $this->user = User::findOrFail($userId);
        $this->userProfile = UserProfile::where('user_id', $userId)->first();
        //we can pass all the properties that we need on here so we can show it on the blog?
        $this->likesCount = $this->user->likes()->count();

// Count of comments
        $this->commentsCount = $this->user->comments()->count();

// Count of posts
        // $this->postsCount = $this->user->posts()->count();
        
    }

    

    public function updateProfile()
    {

        $this->validate([
            'state.jobDescription' => 'required|string|max:255',
            'state.level' => 'nullable|string|max:255',
            'state.location' => 'required|string|max:255',
            'state.bio' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $user->profile->update([
            'jobDescription' => $this->state['jobDescription'],
            'level' => $this->state['level'],
            'location' => $this->state['location'],
            'bio' => $this->state['bio'],
        ]);

        session()->flash('message', 'Profile updated successfully.');
    }
   
    public function render()
    {
        return view('livewire.userprofilePage', [
            'user' => $this->user ,
            'userProfile' => $this->userProfile
        ]);
    }

   

}
