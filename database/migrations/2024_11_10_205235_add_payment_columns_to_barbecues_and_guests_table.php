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
        Schema::table('barbecues', function (Blueprint $table) {
            $table->decimal('total_cost', 8, 2)->nullable();
        });

        Schema::table('guests', function (Blueprint $table) {
            $table->boolean('has_paid')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barbecues', function (Blueprint $table) {
            $table->dropColumn('total_cost');
        });

        Schema::table('guests', function (Blueprint $table) {
            $table->dropColumn('has_paid');
        });
    }
};
