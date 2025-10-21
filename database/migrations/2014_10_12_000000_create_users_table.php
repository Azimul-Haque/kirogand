<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->string('onesignal_id')->nullable();
            $table->string('name');
            $table->string('role')->default('user');
            $table->string('mobile')->unique();
            $table->string('bkash');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // This is the polymorphic key structure for dynamic assignment:
            // 1. authority_id: The ID of the geographical entity (e.g., 10).
            // 2. authority_type: The model name (e.g., 'App\Models\Upazila').
            $table->unsignedBigInteger('authority_id');
            $table->string('authority_type'); // Stores the model class name
            
            // The role of the user within this authority (e.g., 'Chairman', 'Secretary', 'Municipal Mayor')
            $table->string('role');

            // Prevent assigning the same user the same authority multiple times
            $table->unique(['user_id', 'authority_id', 'authority_type']);
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
