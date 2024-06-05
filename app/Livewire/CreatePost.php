<?php


namespace App\Livewire;
use App\Models\Post;
use App\Models\Category; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class CreatePost extends Component implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    public $title = "";
    public $user_id ;
    public $sub_title = "";
    // public $image = ""; //what do we do about the images? //get some url? or do we 
    public $body = "";
    public $categories = [];
    public $image ;

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'body' => 'required',
            // Add validation rules for other attributes if needed
        ]);

        $post = new Post();

        $post->title = $this->title;
        $post->user_id = auth()->id();
        $post->sub_title = $this->sub_title;
        $post->slug = \Str::slug($this->title); // Generate slug from title
        $post->body = $this->body;
        $post->published_at = Carbon::now(); 
        if ($post->image) {
            $imagePath = $this->image->store('images', 'public');
            $post['image'] = $imagePath;
        }
        

        $post->save();
        return redirect('/')->with('success', 'Post created successfully!');

    }

   
        
   


  

    public function render():View
    {
        return view('livewire.createPost', [
            
                'categories' => Category::all()
              
        ]);
    }
    
}