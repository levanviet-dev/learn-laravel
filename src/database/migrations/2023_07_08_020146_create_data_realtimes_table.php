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
        Schema::create('data_realtimes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_id')->constrained(
                table: 'data', indexName: 'data_realtimes_data_id'
            );
            $table->dateTime('communication_time');
            $table->float('pressure')->nullable();
            $table->float('temperature')->nullable();
            $table->tinyInteger('is_alarm')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_realtimes');
    }
};
