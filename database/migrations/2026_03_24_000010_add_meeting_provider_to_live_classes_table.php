<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('live_classes', function (Blueprint $table) {
            $table->string('meeting_provider')->default('external')->after('meeting_url');
            $table->string('meeting_room')->nullable()->after('meeting_provider');
            $table->index(['meeting_provider', 'meeting_room']);
        });
    }

    public function down(): void
    {
        Schema::table('live_classes', function (Blueprint $table) {
            $table->dropIndex(['meeting_provider', 'meeting_room']);
            $table->dropColumn(['meeting_provider', 'meeting_room']);
        });
    }
};

