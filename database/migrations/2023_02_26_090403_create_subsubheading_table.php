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
        Schema::create('subsubheading', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subheading_id')->unsigned();
            $table->longText('title');
            $table->foreign('subheading_id')->references('id')->on('subheading')->cascadeOnDelete();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subsubheading');
    }
};
