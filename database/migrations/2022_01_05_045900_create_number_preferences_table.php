<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumberPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_preferences', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('number_id')->index();
            $table->foreign('number_id')->references('id')->on('numbers')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->string('name');
            $table->string('value');

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
