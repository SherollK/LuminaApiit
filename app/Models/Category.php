<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'text_color',
        'bg_color',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public static function getCategoryList()
    {
        return self::select('id', 'title')->get();

    }

    //for the pivot table among events and categories.
    public function events()
    {
        return $this->belongsToMany(Event::class, 'category_event');
    }

    //for the pivot table 
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'category_user');
    }


}
