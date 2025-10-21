<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unions', function (Blueprint $table) {
            $table->id();
            // Foreign key to Upazila table
            $table->foreignId('upazila_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->string('bn_name');
            $table->string('url')->nullable();
            $table->timestamps();

            // Ensure union names are unique within an upazila
            $table->unique(['upazila_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unions');
    }
}
