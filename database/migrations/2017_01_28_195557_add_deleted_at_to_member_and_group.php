<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtToMemberAndGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function(BluePrint $table) {
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::table('members', function(BluePrint $table) {
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groups', function(BluePrint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('members', function(BluePrint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
