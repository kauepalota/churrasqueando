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
        Schema::table('guests', function (Blueprint $table) {
            $table->decimal('paid_value')->default(0);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->decimal('balance')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->dropColumn('paid_value');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('balance');
        });
    }
};
