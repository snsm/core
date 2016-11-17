<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //保险公司表
        Schema::create('companys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name')->comment('保险公司名');
            $table->string('company_coding')->nullable()->comment('保险编码');
            $table->integer('insurance_type_id')->comment('保险类型');
            $table->integer('parent_id')->default(0)->comment('保险级别ID');
            $table->integer('company_order')->default(0)->comment('排序权重');
            $table->integer('insurance_id')->comment('险种ID');
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
        Schema::dropIfExists('companys');
    }
}
