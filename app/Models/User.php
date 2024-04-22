<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    //defining degree programmes
    const DEGREE_COMPUTING = 'COMPUTING';
    const DEGREE_LAW = 'LAW';
    const DEGREE_BUSINESS = 'BUSINESS';
    
    const DEGREES = [
        self::DEGREE_COMPUTING => 'Degree of Computing',
        self::DEGREE_LAW => 'Degree of Law',
        self::DEGREE_BUSINESS => 'Degree of Business',
    ];

    //defining years
    const LEVEL4 = 'LEVEL_4';
    const LEVEL5 = 'LEVEL_5';
    const LEVEL6 = 'LEVEL_6';

    const LEVELS = [
        self::LEVEL4 => 'Level 4',
        self::LEVEL5 => 'Level 5',
        self::LEVEL6 => 'Level 6',
    ];

    //defining categories
    const CAT_FOUNDATION = 'FOUNDATION';
    const CAT_DEGREE = 'DEGREE';
    const CAT_CONSTANT = 'CONSTANT';
    const CAT_VISITING = 'VISITING';
    const CAT_OTHER = 'OTHER';

    const CATEGORIES = [
        self::CAT_FOUNDATION => 'Foundation',
        self::CAT_DEGREE => 'Degree',
        self::CAT_CONSTANT => 'Full time',
        self::CAT_VISITING => 'Part time',
        self::CAT_OTHER => 'Other',
    ];

    //defining roles for registering users
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_EDITOR = 'EDITOR';
    const ROLE_MODERATOR = 'MODERATOR';
    const ROLE_USER_MANAGER = 'USER_MANAGER';
    const ROLE_TAG_MANAGER = 'TAG_MANAGER';
    const ROLE_ANALTIC = 'ANALTIC';

    const ROLE_USER = 'USER';
    const ROLE_STAFF = 'STAFF';
    const ROLE_ALUMNI = 'ALUMNI';
    const ROLE_DEFAULT = self::ROLE_USER;

    const ROLES = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_EDITOR => 'Content Creator Admin',
        self::ROLE_MODERATOR => 'Moderator Admin',
        self::ROLE_USER_MANAGER => 'User Manager Admin',
        self::ROLE_TAG_MANAGER => 'Tag Manager Admin',
        self::ROLE_ANALTIC => 'Analytical Adimn',

        self::ROLE_USER => 'Student',
        self::ROLE_STAFF => 'Staff',
        self::ROLE_ALUMNI => 'Alumni',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->can('view-admin', User::class);
    }

    public function isAdmin(){
        return $this->role === self::ROLE_ADMIN;
    }

    public function isEditor(){
        return $this->role === self::ROLE_EDITOR;
    }

    public function isModerator(){
        return $this->role === self::ROLE_MODERATOR;
    }

    public function isUserManager(){
        return $this->role === self::ROLE_USER_MANAGER;
    }

    public function isTagManager(){
        return $this->role === self::ROLE_TAG_MANAGER;
    }

    public function isAnalytic(){
        return $this->role === self::ROLE_ANALTIC;
    }

    public function isStaff(){
        return $this->role === self::ROLE_STAFF;
    }

    public function isAlumni(){
        return $this->role === self::ROLE_ALUMNI;
    }

    //to show available roles in the registration dropdown
    public static function getAvailableRoles()
    {
        $availableRoles = self::ROLES;

        // Exclude admin and editor roles
        unset($availableRoles[self::ROLE_ADMIN]);
        unset($availableRoles[self::ROLE_EDITOR]);
        unset($availableRoles[self::ROLE_MODERATOR]);
        unset($availableRoles[self::ROLE_USER_MANAGER]);
        unset($availableRoles[self::ROLE_TAG_MANAGER]);
        unset($availableRoles[self::ROLE_ANALTIC]);

        return $availableRoles;
    }

    public static function getStudentCategories()
    {
        $studentCategories = self::CATEGORIES;

        // Exclude admin and editor roles
        unset($studentCategories[self::CAT_CONSTANT]);
        unset($studentCategories[self::CAT_VISITING]);
        unset($studentCategories[self::CAT_OTHER]);

        return $studentCategories;
    }

    public static function getStaffCategories()
    {
        $staffCategories = self::CATEGORIES;

        // Exclude admin and editor roles
        unset($staffCategories[self::CAT_FOUNDATION]);
        unset($staffCategories[self::CAT_DEGREE]);

        return $staffCategories;
    }

    public static function getYears()
    {
        $years = self::LEVELS;
        return $years;
    }

    public static function getDegrees()
    {
        $degrees = self::DEGREES;
        return $degrees;
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
        'category',
        'year',
        'degree'
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
}
