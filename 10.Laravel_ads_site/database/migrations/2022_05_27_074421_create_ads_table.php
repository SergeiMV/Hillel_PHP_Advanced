<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->foreignId('author_id')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('author_name', 45)
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestampTz('created_at');
            $table->timestampTz('updated_at')->nullable();
            $table->timestampTz('deleted_at')->nullable();

            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('author_name')->references('username')->on('users');
        });
    }

    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['author_name']);
        });

        Schema::dropIfExists('ads');
    }
};
