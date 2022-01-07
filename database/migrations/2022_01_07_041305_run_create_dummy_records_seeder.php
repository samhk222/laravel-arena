<?php

use Database\Seeders\CreateDummyRecordsSeeder;
use Illuminate\Database\Migrations\Migration;

class RunCreateDummyRecordsSeeder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => CreateDummyRecordsSeeder::class,
            '--force' => true,
        ]);
    }
}
