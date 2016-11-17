<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsuranceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //保险类型表
        Schema::create('insurance_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('insurance_type_name')->comment('保险类型名称');
            $table->string('insurance_type_coding')->nullable()->comment('保险类型编号');
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
        Schema::dropIfExists('insurance_types');
    }
}
