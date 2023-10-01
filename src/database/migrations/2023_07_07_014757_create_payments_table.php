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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'payments_user_id'
            );
            $table->tinyInteger('payment_method');
            $table->string('payment_code', 100);
            $table->string('payment_customer_id', 50);
            $table->text('payment_error_message');
            $table->tinyInteger('is_error')->default(0)->comment('False: 0, True: 1');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
