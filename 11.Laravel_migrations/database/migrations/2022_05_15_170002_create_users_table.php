<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        #create users

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();
        });


        #create boards

        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
            $table->foreignId('author_id');

            $table->foreign('author_id')->references('id')->on('users');
        });

        Schema::create('board_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id');
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('board_id')->references('id')->on('boards');
            $table->foreign('user_id')->references('id')->on('users');
        });


        #create columns

        Schema::create('columns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('order');
            $table->foreignId('board_id');
            $table->timestamps();

            $table->foreign('board_id')->references('id')->on('boards');
        });


        #create cards

        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('column_id');
            $table->foreignId('author_id');
            $table->foreignId('executor_id')->nullable();
            $table->string('description');
            $table->timestamps();

            $table->foreign('column_id')->references('id')->on('columns');
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('executor_id')->references('id')->on('users');
        });


	#create comments

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->foreignId('card_id');
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('card_id')->references('id')->on('cards');
            $table->foreign('user_id')->references('id')->on('users');
        });


        #create subscriptions

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id');
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('card_id')->references('id')->on('cards');
            $table->foreign('user_id')->references('id')->on('users');
        });


        #create notifications

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->foreignId('card_id');
            $table->timestamps();

            $table->foreign('card_id')->references('id')->on('cards');
        });

        Schema::create('notification_subscription', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id');
            $table->foreignId('subscription_id');
            $table->timestamps();
            $table->timestamp('viewied_at')->nullable();

            $table->foreign('notification_id')->references('id')->on('notifications');
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
        });
    }

    public function down()
    {

        #drop notifications

        Schema::table('notification_subscription', function (Blueprint $table) {
            $table->dropForeign(['subscription_id']);
            $table->dropForeign(['notification_id']);
        });

        Schema::dropIfExists('notification_subscription');

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['card_id']);
        });

        Schema::dropIfExists('notifications');


        #drop subscriptions
	    
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['card_id']);
        });

        Schema::dropIfExists('subscriptions');


        #drop comments

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['card_id']);
        });

        Schema::dropIfExists('comments');


        #drop cards

        Schema::table('cards', function (Blueprint $table) {
            $table->dropForeign(['executor_id']);
            $table->dropForeign(['author_id']);
            $table->dropForeign(['column_id']);
        });

        Schema::dropIfExists('cards');

 
        #drop columns

        Schema::table('columns', function (Blueprint $table) {
            $table->dropForeign(['board_id']);
        });
        Schema::dropIfExists('columns');


        #drop boards

        Schema::table('board_user', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['board_id']);
        });

        Schema::dropIfExists('board_user');

        Schema::table('boards', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        Schema::dropIfExists('boards');

        #drop users

        Schema::dropIfExists('users');
    }

};
