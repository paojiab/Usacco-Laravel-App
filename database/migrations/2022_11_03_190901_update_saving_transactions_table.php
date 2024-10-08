<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saving_transactions',function(Blueprint $table){
            /** mysql
            * $table->dropColumn('reference');
            * $table->dropColumn('status');
            */
            // sqlite
            $table->dropColumn(['reference','status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
