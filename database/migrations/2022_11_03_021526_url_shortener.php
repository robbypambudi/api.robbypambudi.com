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
        //
        Schema::create('url_shortener', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('url', 512);
            $table->string('short_url', 32);
            $table->string('user_id', 128)->nullable();
            $table->integer('click_count')->default(0);
            $table->timestamp('created_at')->useCurrent();
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
        Schema::dropIfExists('url_shortener');
    }
};
