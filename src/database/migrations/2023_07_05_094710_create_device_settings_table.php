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
        Schema::create('device_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained(
                table: 'devices', indexName: 'device_settings_device_id'
            );
            $table->integer('distance')->nullable()->comment('5, 10, 15, 20, 30, 60');
            $table->float('start_record_pressure')->nullable();
            $table->float('upper_limit_pressure')->nullable();
            $table->float('lower_limit_pressure')->nullable();
            $table->float('upper_limit_temperature')->nullable();
            $table->float('lower_limit_temperature')->nullable();
            $table->text('email_alarm')->nullable();
            $table->tinyInteger('mode')->comment('Remote: 0, Normal: 1');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_settings');
    }
};
