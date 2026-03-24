<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Authorization
            $table->string('role')->default('student')->after('password'); // admin|student
            $table->string('login_id')->nullable()->unique()->after('role');

            // Student profile basics (nullable for admins)
            $table->string('phone')->nullable()->after('login_id');
            $table->foreignId('batch_id')->nullable()->constrained('batches')->nullOnDelete()->after('phone');
            $table->string('photo_path')->nullable()->after('batch_id');
            $table->string('signature_path')->nullable()->after('photo_path');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('batch_id');
            $table->dropUnique(['login_id']);
            $table->dropColumn(['role', 'login_id', 'phone', 'photo_path', 'signature_path']);
        });
    }
};

