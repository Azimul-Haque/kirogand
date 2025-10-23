<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_admins', function (Blueprint $table) {
            $table->id();
            
            // Foreign key to the LocalOffice table
            $table->foreignId('local_office_id')->constrained('local_offices')->onDelete('cascade');
            
            // Foreign key to the User table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Role defines the level of access (e.g., primary_admin, editor, viewer)
            $table->string('role', 50)->default('editor'); 
            
            $table->timestamps();

            // Ensures a user is only linked once to a specific office
            $table->unique(['local_office_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_admins');
    }
}
