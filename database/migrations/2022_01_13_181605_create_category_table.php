<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id()->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('parent_id')->default(0);
            $table->integer('sort')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('link')->nullable();
            $table->integer('image_id')->nullable();
            $table->string('slug')->nullable();


            $table->softDeletes();
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
        Schema::dropIfExists('category');
    }
}
