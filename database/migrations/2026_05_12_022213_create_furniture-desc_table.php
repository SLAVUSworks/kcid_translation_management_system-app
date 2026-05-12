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
        Schema::create('furniture_descs', function (Blueprint $table) {
            $table->id();
            $table->integer('furniture_desc_id')->unique();
            $table->string('furniture_desc_code')->nullable();
            $table->text('title_jp');
            $table->text('title_en');
            $table->text('description_jp')->nullable();
            $table->text('description_en')->nullable();
            $table->timestamps();
            $table->index('furniture_desc_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture_desc');
    }
};
