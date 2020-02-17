<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnonymousVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anonymous_votes', function (Blueprint $table) {
            $table->increments('id')->unsinged();
            $table->tinyInteger('vote');
            $table->integer('post_id')->unsigned()->index()->nullable();
            $table->string('session_id')->index()->nullable();
            $table->unique(['post_id','session_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
