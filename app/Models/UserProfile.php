<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
  
    //commenting this because we need an admin user. 
    // const ROLE_DEFAULT = self::ROLE_USER; 


    // const ROLE_ALUMINI = 'ALUMINI';
    // const ROLE_USER = "USER";
    // const ROLE_OTHER = 'Other';

    const business_school = "APIIT School of Buisiness"; 
    const law_school = "APIIT Law School";
    const computing_school = "APIIT School of Computing";

    const level3 = "  level 3 (Foundation)";
    const level4 = "  level 4 (First Year)";
    const level5 = "  level 5 (Second Year)";
    const level6 = "  level 6 (Third Year)";
    const noLevel = "not a student" ;

    protected $fillable = [
        'user_id',
        'bio',
        'level', //if its student //nullable
        'location', //non nullable //can be used as the school too
        'status', //active or not //boolean value? 
        'jobDescription', //nullable 
        'graduation_year', //nullable.
        'verified_status', //nullable.
        
    

        //consider foundation students graduating to be students scenerio empty fr now. 
        
        
    ];


    
    //finding a blue tick , green tick drama
    public static function getIsVerifiedStatus()
    {
        $role = $this->user->role;
        // Determine the status based on the user's role
        switch ($role) {
            case 'Admin':
            case 'Content Management Admin':
                return 'blue'; // Verified status is blue for Admins and Editors
            case 'Alumni':
                return 'green'; // Verified status is green for Alumni
            case 'Student':
            default:
                return 'none'; // No specific verified status for other roles

                
        }

     
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function getUserRole()
{
    // Assuming the UserProfile model has a 'user' relationship
    return $this->user->role;
}

public static function getLocation()
{
    $locations = [
     self::business_school => "APIIT School of Business",
     self::law_school => "APIIT Law School",
     self::computing_school => "APIIT School of Computing",
    ];
  
    return $locations;
}
    

public static function getlevels()
{
    $levels = [
        self::level3=> "  level 3 (Foundation)",
        self::level4=> "  level 4 (First Year)",
        self::level5=> "  level 5 (Second Year)",
        self::level6=> "  level 6 (Third Year)",
        self::noLevel=> "not a current student",
       ];
     
       return $levels;
}

    //role can be 
         //admin , 
        // student , 
        // alumini, 
        // lecturers are content creator admins
        // otherStaff are also content creator admins. 


}
