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
        Schema::create("player_tags", function (Blueprint $table) {
            $table->integer("player_id")->comment("プレイヤーID");
            $table->integer("tag_id")->comment("タグID");

            $table->foreign("player_id")->references("id")->on("players")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("tag_id")->references("id")->on("tags")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("player_tags");
    }
};