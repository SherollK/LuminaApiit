<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class UpdateProfileForm extends Component
{
    public $state = [];

    public function mount()
    {
        $this->state = [
            'email' => Auth::user()->email,
            'jobDescription' => Auth::user()->profile->jobDescription,
            'level' => Auth::user()->profile->level,
            'location' => Auth::user()->profile->location,
            'bio' => Auth::user()->profile->bio,
        ];
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
        return view('livewire.updateProfileForm');
    }
}
