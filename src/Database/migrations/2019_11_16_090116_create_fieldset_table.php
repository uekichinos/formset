<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fieldset', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('formsetid');
            $table->string('name');
            $table->string('field');
            $table->enum('datatype', ['integer', 'double', 'char', 'varchar', 'text', 'boolean', 'date', 'time', 'datetime', 'binary']);
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
        Schema::dropIfExists('fieldset');
    }
}
