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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name_manager', 50)->after('company_name');
            $table->string('last_name_manager', 50)->after('first_name_manager');
            $table->string('email', 100)->change();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name_manager', 'last_name_manager', 'deleted_at']);
            $table->string('email')->change();
        });
    }
};
