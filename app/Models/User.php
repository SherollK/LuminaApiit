<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_CONTENT_MNG = 'CONTENT_MNG';
    const ROLE_CATEGORY_MNG = "CATEGORY_MNG";
    const ROLE_USER_MNG = "USER_MNG";
    const ROLE_ALUMINI = 'ALUMINI';
    const ROLE_USER = "USER";
    const ROLE_DEFAULT = "USER";
    const ROLE_OTHER = 'Other';

    //commenting this because we need an admin user.

    const ROLES = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_CONTENT_MNG => 'Content Management Admin',
        self::ROLE_CATEGORY_MNG => 'Category Mangement Admin',
        self::ROLE_USER_MNG  => 'User Management Admin',
        self::ROLE_ALUMINI => 'Past Student',
        self::ROLE_USER => 'Current Student',
        self::ROLE_OTHER => 'Other',




    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->can('view-admin', User::class);
    }

    public function isAdmin(){
        return $this->role === self::ROLE_ADMIN;
    }

    public function isContentMng(){
        return $this->role === self::ROLE_CONTENT_MNG;
    }

    public function isCategoryMng(){
        return $this->role === self::ROLE_CATEGORY_MNG;
    }

    public function isUserMng(){
        return $this->role === self::ROLE_USER_MNG;
    }

    public function isAlumini(){
        return $this->role === self::ROLE_ALUMINI;
    }

    public function isStudent(){
        return $this->role === self::ROLE_USER;
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',

        //mass asigning is_aproved to students who have
        //who can post
            //students

        'is_approved'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'post_like')->withTimestamps();
    }

    public function hasLiked(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public static function getAvailableRoles()
    {
        $availableRoles = self::ROLES;
        unset($availableRoles[self::ROLE_CONTENT_MNG]);
        unset($availableRoles[self::ROLE_CATEGORY_MNG]);
        unset($availableRoles[self::ROLE_USER_MNG]);
        unset($availableRoles[self::ROLE_ADMIN]);

        return $availableRoles;


    }


    //for the pivot table for matching users with categories.
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_user');
    }

    public function getDescription(): string
    {
        // Define descriptions for each role
        $descriptions = [
            self::ROLE_ALUMINI => 'Verify if these users are credible alumini',
            self::ROLE_USER => 'Verify if these users are credible students',
            self::ROLE_OTHER => "Verify what users they are and give them necessary roles. "
            // Add descriptions for other roles here
        ];

        // Return the description based on the role of the user
        return $descriptions[$this->role] ?? '';
    }

}

