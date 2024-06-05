<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class PostList extends Component
{
    //enables pagination 
    use WithPagination;
    


    // Should be included in the URL when passed as parameters
    //public properties of the class: 
        //Sorting direction 
        //Search function 
        //category 
    #[Url()]
    public $sort = 'desc';
    
    #[Url()]
    public $search = '';

    #[Url()]
    public $category = '';



    //setting the sort direction 
    public function setSort($sort)
    {
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
    }



    #[On('search')]//triggered when search event occurs. 
    public function updateSearch($search)
    {
        $this->search = $search;
    }

    //clean file
    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->resetPage(); //user returns to first page of results 
    }

    #[Computed()]
    //run everysingle time one of these changed. 
    //uses literally all of the other stuff
    public function posts()
    {
        return Post::published() //from the scope 
            // ->visible() 
            ->with('author', 'categories') //Eager loading 
            ->orderBy('published_at', $this->sort)
            ->when($this->activeCategory, function ($query) {
                $query->withCategory($this->category);
            })
            ->where('title', 'like', "%{$this->search}%")
            ->paginate(10);
    }

    #[Computed()] //whenerver the dependancy changes it is recomputed ----> can connect this to tags. 
    //the function lets you pass the active category 
    public function activeCategory()
    {
        if(!$this->category === null || $this->category === ''){
            return null;
        }
    
        return Category::where('slug', $this->category)->first();
    }

    //lets you summon it to a different page. 
    public function render()
    {
        return view('livewire.post-list');
    }
}
