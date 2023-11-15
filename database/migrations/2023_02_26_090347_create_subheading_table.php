<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subheading', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('heading_id')->unsigned();
            $table->longText('title');
            $table->foreign('heading_id')->references('id')->on('heading')->cascadeOnDelete();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subheading');
    }
};
