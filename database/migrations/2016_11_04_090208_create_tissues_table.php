<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTissuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tissues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tissue_name')->nullable()->comment('组织名称');
            $table->string('tissue_coding')->nullable()->comment('组织编码');
            $table->tinyInteger('tissue_type')->comment('组织类型');
            $table->integer('parent_id')->default(0)->comment('上级组织ID');
            $table->integer('tissue_level')->default(1)->comment('组织级别');
            $table->integer('tissue_order')->default(0)->comment('排序权重');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tissues');
    }
}
