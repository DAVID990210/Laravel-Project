<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('dpi');
            $table->integer('status')->default(1);
            $table->string('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->integer('status')->default(1);
            $table->string('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->integer('status')->default(1);
            $table->string('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });        
        Schema::table('institutions', function (Blueprint $table) {
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
            $table->dropColumn('dpi');
            $table->dropColumn('status');
            $table->dropColumn('deleted_by');
            $table->dropColumn('deleted_at');
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('deleted_by');
            $table->dropColumn('deleted_at');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('deleted_by');
            $table->dropColumn('deleted_at');
        });
        Schema::table('institutions', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('deleted_by');
            $table->dropColumn('deleted_at');
        });
    }
};
