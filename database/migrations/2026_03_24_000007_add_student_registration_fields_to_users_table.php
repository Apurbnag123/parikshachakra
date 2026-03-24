<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('father_name')->nullable()->after('last_name');
            $table->string('gender')->nullable()->after('father_name'); // male|female|other
            $table->text('address')->nullable()->after('gender');
            $table->string('pincode', 10)->nullable()->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'father_name',
                'gender',
                'address',
                'pincode',
            ]);
        });
    }
};

