<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tracks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained('artists', 'id')->onDelete('restrict');
            $table->unsignedBigInteger('service_track_id')->index();
            $table->string('title', 500);
            $table->unsignedBigInteger('duration')->comment('seconds');
            $table->string('link', 1000);
            $table->text('description')->nullable();
            $table->string('license')->nullable();
            $table->unsignedBigInteger('comments')->default(0)->comment('comments count');
            $table->unsignedBigInteger('likes')->default(0)->comment('likes count');
            $table->unsignedBigInteger('playback')->default(0)->comment('playback count');
            $table->unsignedBigInteger('download')->default(0)->comment('download count');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks');
    }
}
