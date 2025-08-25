<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropProfilesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('profiles');
    }

    public function down()
    {
        Schema::create('profiles', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('username')->nullable()->unique();
            $table->date('birthday')->nullable();
            $table->string('profile_picture')->nullable();
            $table->text('about_me')->nullable();
            $table->timestamps();
        });
    }
}