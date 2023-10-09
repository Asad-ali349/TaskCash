<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisputeChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispute_chats', function (Blueprint $table) {
            $table->id();
            $table->integer('dispute_id');
            $table->text('message')->nullable();
            $table->integer('sender');
            $table->integer('receiver');
            $table->integer('sent_by');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispute_chats');
    }
}
