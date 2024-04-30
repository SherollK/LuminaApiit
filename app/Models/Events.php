<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\AvailableEventsScope;
use Carbon\Carbon;
use Illuminate\Support\Str; 





class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'description',
        'published_at',
        'date',
        'time',
        'location'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'date' => 'date',
     'availability' => 'boolean',
      
        // 'time' => 'time'

    ];
    

    //need a global scope to show only events that are available. 
    // protected static function booted(): void
    // {
    //     static::addGlobalScope(new AvailableEventsScope());

    // }

    //Each event has an author
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Each event can have many categories 
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

     //Finds out events that are available and not et has been held. 
     //do we need this now that we have a global scope?
    // public function availability($query)
    // {
    //     $query->where('date', '>=', Carbon::now());
        
    // }


    public function getAvailabilityAttribute()
    {
        // Calculate availability based on the event date
        return $this->date >= Carbon::today();
    }
    
    //gets category based filtering 
    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category);
        });
    }


    //getting the excerpt of really long paragrapgh
    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->description), 150);
    }



    //to store the images and get a url
    //or to use laravel media library 
    public function getThumbnailUrl()
    {
        //if its exteral link its a url
        $isUrl = str_contains($this->image, 'http');

        //else makes a url using laravel's storage facade --> makes a fake url to reach it 
        return ($isUrl) ? $this->image : Storage::disk('public')->url($this->image);

        //might have to use the same thing for events too. 
    }



}
