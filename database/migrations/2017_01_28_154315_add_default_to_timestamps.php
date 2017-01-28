<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultToTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `member_transactions` CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT NOW();');
        DB::statement('ALTER TABLE `member_transactions` CHANGE COLUMN `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT NOW();');
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `member_transactions` CHANGE COLUMN `created_at` `created_at` TIMESTAMP NULL DEFAULT NULL;');
        DB::statement('ALTER TABLE `member_transactions` CHANGE COLUMN `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;');
        //
    }
}
