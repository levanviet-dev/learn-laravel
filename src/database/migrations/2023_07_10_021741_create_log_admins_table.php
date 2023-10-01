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
        Schema::create('log_admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained(
                table: 'admins', indexName: 'log_admins_admin_id'
            );
            $table->dateTime('login_time')->nullable();
            $table->dateTime('logout_time')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_admins');
    }
};
