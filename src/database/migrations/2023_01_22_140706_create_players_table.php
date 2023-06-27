<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("players", function (Blueprint $table) {
            $table->uuid("id", 36)->primary()->comment("プレイヤーID");
            $table->string("name")->comment("プレイヤー活動名");
            $table->string("steam_id")->nullable()->comment("SteamId");
            $table->string("discord_id")->nullable()->comment("DiscordID");
            $table->uuid("clan_id", 36)->nullable()->comment("クランID");
            $table->integer("battle_metrics_id")->comment("BattleMetricsID");
            $table->uuid("created_user_id", 36)->comment("作成ユーザID");
            $table->timestamps();

            $table->foreign("clan_id")->references("id")->on("clans")->onUpdate("SET NULL")->onDelete("SET NULL");
            $table->foreign("created_user_id")->references("id")->on("users")->onUpdate("CASCADE")->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("players");
    }
};
