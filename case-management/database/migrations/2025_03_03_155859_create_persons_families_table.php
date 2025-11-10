<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsFamiliesTable extends Migration
{
    public function up()
    {
        Schema::create('persons_families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('persons')->onDelete('restrict');
            $table->foreignId('family_id')->constrained('families')->onDelete('restrict');
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by')->constrained('users')->onDelete('restrict');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('persons_families');
    }
}
