<?php

use Database\Seeders\AddUsersSeeders;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RunAddUsersSeeders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => AddUsersSeeders::class,
            '--force' => true,
        ]);
    }
}
