<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipsTable extends Migration
{
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id_1')->nullable();
            $table->unsignedBigInteger('person_id_2')->nullable();
            $table->unsignedBigInteger('relationship_type_id')->nullable();
            $table->timestamps();
            $table->string('created_by', 255);
            $table->string('updated_by', 255);
            $table->comment('Defines how individuals are related');
        });
    }

    public function down()
    {
        Schema::dropIfExists('relationships');
    }
}