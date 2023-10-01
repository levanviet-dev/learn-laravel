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
        Schema::table('admins', function (Blueprint $table) {
            $table->softDeletes();
            $table->foreignId('role_id')->after('password')->constrained(
                table: 'roles', indexName: 'admins_role_id_foreign'
            );
            $table->foreignId('parent_id')->after('id')->default(1)->constrained(
                table: 'admins', indexName: 'admins_admin_id_foreign'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['admin_id']);
            $table->dropColumn(['deleted_at']);
        });
    }
};
