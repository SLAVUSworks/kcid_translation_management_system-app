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
        Schema::create('translation_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('reference_id');
            $table->enum('status', [ 'untranslated', 'on-progress', 'translated', ])->default('untranslated');
            $table->timestamps();
            $table->unique([ 'type', 'reference_id' ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translation_statuses');
    }
};
