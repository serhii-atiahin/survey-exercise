<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('remember_token', 100)->nullable();

            $table->unique('name');
        });

        DB::table('users')->insert([
            'name' => 'Torvalds',
            'password' => '$2y$10$xjeV.pR0ScKCxjXmeaKWKO3X/AFUQBkotV886f5Kdaty4.7R6FmwO',
        ]);
        DB::table('users')->insert([
            'name' => 'Gudbrand',
            'password' => '$2y$10$xjeV.pR0ScKCxjXmeaKWKO3X/AFUQBkotV886f5Kdaty4.7R6FmwO',
        ]);
        DB::table('users')->insert([
            'name' => 'Thorbjorn',
            'password' => '$2y$10$xjeV.pR0ScKCxjXmeaKWKO3X/AFUQBkotV886f5Kdaty4.7R6FmwO',
        ]);
        DB::table('users')->insert([
            'name' => 'Yngwar',
            'password' => '$2y$10$xjeV.pR0ScKCxjXmeaKWKO3X/AFUQBkotV886f5Kdaty4.7R6FmwO',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
