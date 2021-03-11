<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmiInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emi_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emi_id')->constrained('emis')->onDelete('cascade');
            $table->dateTime('date');
            $table->integer('installment_no')->nullable();
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
        Schema::dropIfExists('emi_installments');
    }
}
