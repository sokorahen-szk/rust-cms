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
        Schema::create("clans", function (Blueprint $table) {
            $table->uuid('id', 36)->primary()->comment("クランID");
            $table->string("name")->comment("クラン名");
            $table->string("image_url")->nullable()->comment("クラン画像URL");
            $table->string("introduction")->nullable()->comment("紹介文");
            $table->uuid("created_user_id", 36)->comment("作成ユーザID");
            $table->timestamps();

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
        Schema::dropIfExists("clans");
    }
};
