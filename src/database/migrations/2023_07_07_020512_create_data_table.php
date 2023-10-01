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
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained(
                table: 'devices', indexName: 'data_user_id'
            );
            $table->bigInteger('distance')->nullable();
            $table->float('start_record_pressure')->nullable();
            $table->float('upper_limit_pressure')->nullable();
            $table->float('lower_limit_pressure')->nullable();
            $table->float('upper_limit_temperature')->nullable();
            $table->float('lower_limit_temperature')->nullable();
            $table->dateTime('accreditation_time')->nullable();
            $table->float('pressure')->nullable();
            $table->float('temperature')->nullable();
            $table->float('temperature_start_to_measure')->nullable();
            $table->float('temperature_drop_threshold')->nullable();
            $table->dateTime('last_measurament_time')->nullable();
            $table->text('email_alarm')->nullable();
            $table->tinyInteger('mode')->nullable()->comment('Remote: 0, Normal: 1');
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
        Schema::dropIfExists('data');
    }
};
