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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->double('principal');
            $table->double('interest');
            $table->integer('duration');
            $table->double('loan_fee');
            $table->double('disburse_amount');
            $table->text('reason');
            $table->double('balance');
            $table->date('maturity_date');
            $table->string('status');
            $table->string('guarantor')->nullable();
            $table->string('collateral')->nullable();
            $table->string('collateral_url')->nullable();
            $table->string('collateral_ownership_url')->nullable();
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
        Schema::dropIfExists('loans');
    }
};
