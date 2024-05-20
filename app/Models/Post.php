<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'user_id',
        'title',
        'sub_title',
        'slug',
        'image',
        'body',
        'published_at',
        'featured',
        'hide',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
    
    //from the userId gets the User object 
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //if the author's role is a CNT_MNG_ADMIN or ALUMINI. 
        //hide feature becomes false
    //ELse hide feature is true. 
    //this is done in the createPostController.

    //then only posts with hide attribute false are shown in the post list. 
    //in the postlist livewire file. 

    
    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }

    public function visibility()
    {
        // Check if the author has the role of ROLE_ALUMINI or CONTENT_MNG
        if ($this->author->role == "ROLE_ALUMINI" || $this->author->role == "CONTENT_MNG") {
            // If the user is an alumnus or content manager, get the value of hide
            $hide = $this->author->hide; 
    
            // Return false if hide is true, indicating that the post should be hidden
            return !$hide;
        }
    
        // If the user does not have the specified roles, the post should be visible
        return true;
    }
    
    
    //returns posts that were published before today. 

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    //returns posts that have the featured tag on 
    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }

    

    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category);
        });
    }


    //for events I think we need one to say which ones are not gone. 

    //prolly used to show just a section of the text 
    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->body), 150);
    }


    //calculates reading time of the blog and makes evertithing alwas less than 1 min 
    public function getReadingTime()
    {
        $mins = round(str_word_count($this->body) /250);
        return ($mins < 1) ? 1 : $mins;
    }
    
    public function getThumbnailUrl()
    {
        //if its exteral link its a url
        $isUrl = str_contains($this->image, 'http');

        //else makes a url using laravel's storage facade --> makes a fake url to reach it 
        return ($isUrl) ? $this->image : Storage::disk('public')->url($this->image);

        //might have to use the same thing for events too. 
    }
   
}
