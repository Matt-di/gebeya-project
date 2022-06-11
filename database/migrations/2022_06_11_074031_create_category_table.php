<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('parent_id')->nullable();
            $table->string('name')->unique('slug');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by');
            $table->rememberToken();
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
