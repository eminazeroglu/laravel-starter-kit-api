<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_meta_tags', function (Blueprint $table) {
            $table->id();
            $table->text('url')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();
            $table->json('bots')->nullable();
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
        Schema::dropIfExists('seo_meta_tags');
    }
};
