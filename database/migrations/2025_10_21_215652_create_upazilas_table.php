<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpazilasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upazilas', function (Blueprint $table) {
            $table->id();
            // Foreign key to District table
            $table->foreignId('district_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->string('bn_name');
            $table->string('url')->nullable();
            $table->timestamps();

            // Ensure upazila names are unique within a district
            $table->unique(['district_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upazilas');
    }
}
