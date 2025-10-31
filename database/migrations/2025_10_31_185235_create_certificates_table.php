<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            // This links to your main users table
            $table->foreignId('recipient_user_id')->constrained('users')->onDelete('cascade'); 
            
            // Key fields for lookup and template selection
            $table->string('certificate_type', 50)->comment('e.g., birth_standard, academic_transcript, etc.');
            $table->integer('status', 2);
            $table->string('unique_serial', 100)->unique();
            
            // The JSON column that holds all variable data
            $table->json('data_payload'); 
            
            $table->timestamp('issued_at');
            $table->timestamps();
            
            // Index the type for fast filtering/reporting
            $table->index('certificate_type'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
