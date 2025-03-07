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
            $table->string('username')->unique()->nullable();
            $table->string('profession')->nullable();
            $table->string('pays')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->text('infos')->nullable();
            $table->string('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('profession');
            $table->dropColumn('pays');
            $table->dropColumn('adresse');
            $table->dropColumn('ville');
            $table->dropColumn('infos');
            $table->dropColumn('photo');
        });
    }
};
