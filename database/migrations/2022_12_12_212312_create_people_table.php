<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->enum('type', ['FAITHFUL', 'PROVIDER']);
            $table->string('name', 190);
            $table->enum('document_type', ['CPF', 'CNPJ']);
            $table->string('document', 20)->unique();
            $table->string('email')->unique();
            $table->string('phone', 15);
            $table->enum('phone_whatsapp', ['Y', 'N']);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
