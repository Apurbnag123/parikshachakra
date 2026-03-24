<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('live_classes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('meeting_url');
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->boolean('is_published')->default(true);
            $table->foreignId('batch_id')->nullable()->constrained('batches')->nullOnDelete(); // null => all
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['is_published', 'starts_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('live_classes');
    }
};

