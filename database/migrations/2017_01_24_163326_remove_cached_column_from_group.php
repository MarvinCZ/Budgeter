<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCachedColumnFromGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function(BluePrint $table) {
            $table->dropColumn('cached_budget');
        });

        Schema::table('member_transactions', function(BluePrint $table) {
            $table->dropForeign('member_transactions_transaction_id_foreign');
        });

        Schema::table('member_transactions', function(BluePrint $table) {
            $table->integer('transaction_id')->nullable(false)->unsigned()->change();
            $table->foreign('transaction_id')->references('id')->on('transactions');
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
            $table->integer('cached_budget');
        });

        Schema::table('member_transactions', function(BluePrint $table) {
            $table->dropForeign('member_transactions_transaction_id_foreign');
            $table->integer('transaction_id')->nullable(true)->unsigned()->change();
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }
}
