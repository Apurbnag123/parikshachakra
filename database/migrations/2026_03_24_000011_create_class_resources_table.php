<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_resources', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // video | note
            $table->string('title');
            $table->longText('body')->nullable(); // notes text (optional)
            $table->string('url')->nullable(); // external video URL (optional)
            $table->string('file_path')->nullable(); // uploaded video/note under public disk (optional)
            $table->string('mime_type')->nullable();
            $table->boolean('is_published')->default(true);
            $table->dateTime('published_at')->nullable();
            $table->foreignId('batch_id')->nullable()->constrained('batches')->nullOnDelete(); // null => all
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['type', 'is_published', 'published_at']);
            $table->index(['batch_id', 'is_published']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_resources');
    }
};

