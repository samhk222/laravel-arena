<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('description');
            $table->string('color');
            $table->smallInteger('allow_customers')->default(0);
            $table->smallInteger('allow_numbers')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
