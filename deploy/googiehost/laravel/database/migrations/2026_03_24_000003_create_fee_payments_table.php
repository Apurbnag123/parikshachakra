<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_account_id')->constrained('fee_accounts')->cascadeOnDelete();
            $table->string('receipt_no')->unique();
            $table->decimal('amount', 10, 2);
            $table->date('paid_on');
            $table->string('payment_mode')->default('cash'); // cash|upi|bank|card|other
            $table->string('reference_no')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['paid_on', 'payment_mode']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_payments');
    }
};

