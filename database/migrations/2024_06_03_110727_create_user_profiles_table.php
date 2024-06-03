<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table -> string('bio');
            $table -> string('location');
            $table -> string('jobDescription')->nullable();
            //job descriptions can include job des. for alumini , and for students it can be the level ,
            $table -> integer('graduationYear')->nullable();


            //there;s a typo here leave it here
            $table -> string('verifedStatus');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};

