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

 

    public function mount($userId)
    {

        $this->userId = $userId;
        $this->user = User::findOrFail($userId);
        $this->userProfile = UserProfile::where('user_id', $userId)->first();
        //we can pass all the properties that we need on here so we can show it on the blog?
     
        
    }
   
    public function render()
    {
        return view('livewire.userprofilePage', [
            'user' => $this->user ,
            'userProfile' => $this->userProfile
        ]);
    }

   

}
