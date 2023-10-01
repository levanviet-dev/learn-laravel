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
            $table->string('user_code', '100')->after('id')->unique();
            $table->string('company_name')->after('password');
            $table->string('department')->nullable()->after('company_name');
            $table->string('postal_code')->after('department');
            $table->string('prefecture')->after('postal_code');
            $table->text('address')->after('prefecture');
            $table->string('building_name')->nullable()->after('address');
            $table->string('phone_number')->after('building_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['user_code']);
        });
    }
};
