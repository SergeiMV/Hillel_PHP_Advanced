<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 45)->unique();
            $table->string('email', 45)->unique();
            $table->string('password', 255)->unique();
            $table->timestampTz('created_at');
            $table->timestampTz('updated_at')->nullable();
            $table->timestampTz('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
