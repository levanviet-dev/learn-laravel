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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'payment_histories_user_id'
            );
            $table->string('reason');
            $table->float('amount');
            $table->tinyInteger('payment_method');
            $table->string('payment_code', 100);
            $table->string('payment_method_id', 50);
            $table->text('payment_error_message')->nullable();
            $table->dateTime('payment_date');
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
        Schema::dropIfExists('payment_histories');
    }
};
