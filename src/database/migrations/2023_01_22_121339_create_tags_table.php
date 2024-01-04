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
        Schema::create("tags", function (Blueprint $table) {
            $table->uuid("id", 36)->primary()->comment("タグID");
            $table->string("name")->unique()->comment("タグ名");
            $table->tinyInteger("display_order")->comment("表示順番");
            $table->string("description")->nullable()->comment("備考");
            $table->boolean("is_enabled")->comment("タグ有効有無");
            $table->boolean("is_display_on_top")->comment("トップページ表示可否");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("tags");
    }
};
