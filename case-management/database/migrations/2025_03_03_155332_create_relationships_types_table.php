<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipsTypesTable extends Migration
{
    public function up()
    {
        Schema::create('relationship_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->comment('Defines types of relationships (e.g. child, parent, case manager)');
        });
    }

    public function down()
    {
        Schema::dropIfExists('relationship_types');
    }
}