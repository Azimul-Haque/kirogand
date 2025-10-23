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

            // Office Contact & Visual Information
            $table->string('email')->nullable()->unique();
            $table->string('phone', 20)->nullable();
            $table->string('monogram', 255)->nullable();
            
            // Office Identification
            $table->string('authority_name_bn', 150); // Office/Authority's full name in Bengali
            $table->string('authority_type', 50); // E.g., 'Union Parishad', 'Pourasava', 'District Council'
            $table->boolean('is_active')->default(true);

            // --- REFACTORING: Single Geographical Anchor ID ---
            // This single ID represents the lowest administrative unit this office belongs to 
            // (e.g., Union ID, Paurashava ID, or District ID if it's a high-level office).
            // All higher-level IDs (District, Division) must be derived via joins.
            $table->string('geo_location_id', 10)->nullable();
            // --- END REFACTORING ---
            
            $table->timestamps();
            
            // We can still index this single column for quick lookup
            $table->index('geo_location_id');
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
