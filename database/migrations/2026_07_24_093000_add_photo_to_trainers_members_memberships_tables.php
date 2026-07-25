<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('phone');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('phone');
        });

        Schema::table('memberships', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropColumn('photo');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('photo');
        });

        Schema::table('memberships', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }
};

