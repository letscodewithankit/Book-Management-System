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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('book_id')->nullable()->unsigned();
            $table->bigInteger('chapter_id')->nullable()->unsigned();
            $table->bigInteger('heading_id')->nullable()->unsigned();
            $table->bigInteger('subheading_id')->nullable()->unsigned();
            $table->bigInteger('subsubheading_id')->nullable()->unsigned();
            $table->longText('cdescription');
            $table->foreign('book_id')->references('id')->on('book')->cascadeOnDelete();
            $table->foreign('chapter_id')->references('id')->on('chapter')->cascadeOnDelete();
            $table->foreign('heading_id')->references('id')->on('heading')->cascadeOnDelete();
            $table->foreign('subheading_id')->references('id')->on('subheading')->cascadeOnDelete();
            $table->foreign('subsubheading_id')->references('id')->on('subsubheading')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
