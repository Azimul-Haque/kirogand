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
            $table->string('name', 150); // Office's full name in Bengali
            $table->string('office_type', 50); // E.g., 'Union Parishad', 'Pourasava', 'District Council'
            $table->boolean('is_active')->default(true);
            
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
        Schema::dropIfExists('local_offices');
    }
}
