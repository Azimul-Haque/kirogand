<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            // Foreign key to Division table
            $table->foreignId('division_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->string('bn_name');
            $table->decimal('lat', 10, 8)->nullable(); // Latitude
            $table->decimal('lon', 11, 8)->nullable(); // Longitude
            $table->string('url')->nullable();
            $table->timestamps();

            // Ensure district names are unique within a division
            $table->unique(['division_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
