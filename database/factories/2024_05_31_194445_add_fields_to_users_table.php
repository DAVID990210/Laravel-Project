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
        Schema::table('users', function (Blueprint $table) {
            $table->string('second_name')->nullable();
            $table->string('third_name')->nullable();
            $table->string('username')->unique();
            $table->string('first_lastname');
            $table->string('second_lastname')->nullable();
            $table->string('married_surname')->nullable();
            $table->bigInteger('dpi');
            $table->integer('status')->default(1);
            $table->string('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('second_name');
            $table->dropColumn('third_name');
            $table->dropColumn('username');
            $table->dropColumn('first_lastname');
            $table->dropColumn('second_lastname');
            $table->dropColumn('married_surname');
            $table->dropColumn('dpi');
            $table->dropColumn('status');
            $table->dropColumn('deleted_by');
            $table->dropColumn('deleted_at');
        });
    }
};