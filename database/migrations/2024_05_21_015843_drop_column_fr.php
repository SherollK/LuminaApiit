<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Change the default value of the 'hide' column to true
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('hide')->default(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert the default value of the 'hide' column to false
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('hide')->default(false)->change();
        });
    }
};

