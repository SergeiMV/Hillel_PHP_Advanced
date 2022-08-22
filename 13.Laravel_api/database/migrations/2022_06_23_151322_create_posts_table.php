<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
            $table->integer('upvotes_count')->default(0);
            $table->foreignId('author_id')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('author_name')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestampTz('created_at');
            $table->timestampTz('updated_at');
            $table->softDeletesTz();

            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('author_name')->references('username')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['author_name']);
        });
        Schema::dropIfExists('posts');
    }
};
