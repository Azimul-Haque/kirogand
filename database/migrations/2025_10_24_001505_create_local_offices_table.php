<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_offices', function (Blueprint $table) {
            $table->id();

            // Link to the user who administers this office
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            
            // Office Contact & Visual Information
            $table->string('email')->nullable()->unique(); // Official email (optional, but unique if present)
            $table->string('phone', 20)->nullable(); // Official phone number
            $table->string('monogram', 255)->nullable(); // Path or identifier for the office's monogram
            
            // Office Identification
            $table->string('authority_name_bn', 150); // Office/Authority's full name in Bengali
            $table->string('authority_type', 50); // E.g., 'Union Parishad', 'Pourasava'
            $table->boolean('is_active')->default(true);

            // Geographical Hierarchy IDs (Location of the office)
            $table->string('division_id', 10);
            $table->string('district_id', 10);
            
            // Nullable for non-Upazila/Union level entities
            $table->string('upazila_id', 10)->nullable();
            $table->string('union_id', 10)->nullable();
            
            $table->timestamps();
            
            // Indexing for faster lookups
            $table->index(['district_id', 'upazila_id', 'union_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_offices');
    }
}
