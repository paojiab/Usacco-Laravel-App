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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('acct_no');
            $table->string('acct_type');
            $table->string('status');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('sex');
            $table->string('occupation');
            $table->date('date_of_birth');
            $table->string('tel');
            $table->string('nationality');
            $table->string('address');
            $table->string('next_of_kin');
            $table->string('rel_kin');
            $table->string('tel_kin');
            $table->string('id_type');
            $table->string('id_no');
            $table->string('id_front');
            $table->string('id_back')->nullable();
            $table->string('passport_photo');
            $table->string('signature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
