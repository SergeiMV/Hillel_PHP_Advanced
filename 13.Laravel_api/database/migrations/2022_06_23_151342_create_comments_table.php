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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('author_id')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('author_name')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->text('content');
            $table->timestampTz('created_at');
            $table->timestampTz('updated_at');
            $table->softDeletesTz();

            $table->foreign('post_id')->references('id')->on('posts');
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
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['author_id']);
            $table->dropForeign(['author_name']);
        });

        Schema::dropIfExists('comments');
    }
};
