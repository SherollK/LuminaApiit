<?php

namespace App\Livewire;

use App\Models\Events;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EventsList extends Component
{
    use WithPagination; 
   

    // public function setSort($sort)
    // {
    //     $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
    // }


    #[Computed()]
    public function events()
    {
        return Events:: //from the scope 
            with('author')
            ->orderBy('date', 'asc')

            //add these when you figure stuff out 
                // ->when($this->activeCategory, function ($query) {
                //     $query->withCategory($this->category);
                // })
                // ->where('title', 'like', "%{$this->search}%")
            ->paginate(5);
    }

    //requirements 
        //need a basic list of all events 
            //all events that are available in the fture. 
            //sorting should be closest
            //all events that fall under one category 
            
            //function to pass all events first 

            //function to get all available ones: done 
            //function to get category 


    public function render()
    {
        return view('livewire.events-list');
    }


}