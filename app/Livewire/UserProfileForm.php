<?php

namespace App\Livewire;

use Livewire\Component;
use App\Policies\UpdateUserProfilePolicy; 

class UserProfileForm extends Component
{
    public $state = []; // Array to store user profile data

    public function mount()
    {
        $this->state = Auth::user()->toArray(); // Populate initial state with user data
    }

    public function render()
    {
        $policy = new UpdateUserProfilePolicy; // Creating a new policy instance

        $fields = [
            'category' => [ // Only visible to staff
                'label' => __('Category'),
                'type' => 'select', 
                'options' => [], // Empty options array (placeholder)
            ],
            'year' => [ // Only visible to students
                'label' => __('Levels'),
                'type' => 'select', 
                'options' => [],
            ],
        ];

        $categories = User::getStaffCategories(); // Fetch categories 
        // Populate options array dynamically
        $fields['category']['options'] = $categories;

        $levels = User::getYears(); 
        $fields['year']['options'] = $levels;

        dd($fields);

        return view('livewire.update-profile-information-form', compact('fields', 'policy'));
    }

    public function updatedState($fieldName)
    {
        // Handle state updates when user interacts with fields
    }

    public function updateProfile()
    {
        //$this->validate(); // Define validation rules within your component

        // Use UpdateUserProfileInformation class to update profile
        UpdateUserProfileInformation::update(auth()->user(), $this->state);

        // Emit an event to display a success message (optional)
        $this->emit('saved');
    }

}

