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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('nama', 250);
            $table->string('alamat', 250);
            $table->date('tgl_lahir');
            $table->string('username');
            $table->string('password');
            $table->timestamps();

        });
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin,pelanggan,mitra'])->after('password');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
