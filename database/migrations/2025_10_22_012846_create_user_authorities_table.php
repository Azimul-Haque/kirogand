<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_authorities', function (Blueprint $table) {
            $table->id();
            // Foreign key to the users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // This is the polymorphic key structure for dynamic assignment:
            // 1. authority_id: The ID of the geographical entity (e.g., 10).
            // 2. authority_type: The model name (e.g., 'App\Models\Upazila').
            $table->unsignedBigInteger('authority_id');
            $table->string('authority_type'); // Stores the model class name
            
            // The role of the user within this authority (e.g., 'Chairman', 'Secretary', 'Municipal Mayor')
            $table->string('role');

            $table->timestamps();

            // Prevent assigning the same user the same authority multiple times
            $table->unique(['user_id', 'authority_id', 'authority_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_authorities');
    }
}
