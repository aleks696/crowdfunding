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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('card_name')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_expiration')->nullable();
            $table->string('card_cvv')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('card_name');
            $table->dropColumn('card_number');
            $table->dropColumn('card_expiration');
            $table->dropColumn('card_cvv');
        });
    }
};
