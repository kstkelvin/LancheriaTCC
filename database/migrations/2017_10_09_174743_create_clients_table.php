<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{


  public function up()
  {
    //função do Eloquent usada para enviar os dados para o banco de dados.
    Schema::create('clients', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('surname')->nullable();
      $table->string('setor');
      $table->string('phone_number')->nullable();
      $table->double('total')->default('0.00');
    });
  }


  public function down()
  {
    //Table drop, no caso de não existir, a função não é evocada.
    Schema::dropIfExists('clients');
  }
}
