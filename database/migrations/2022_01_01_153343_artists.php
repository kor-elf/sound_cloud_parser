<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Artists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('service_type');
            $table->unsignedBigInteger('followers');
            $table->string('link', 1000);
            $table->string('full_name', 500);
            $table->string('username', 500);
            $table->text('description')->nullable();
            $table->string('city')->nullable();
            $table->string('country_code')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['service_id', 'service_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artists');
    }
}
