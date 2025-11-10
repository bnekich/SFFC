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
            $table->foreignId('person_id_1')->nullable()->constrained('persons')->onDelete('set null');
            $table->foreignId('person_id_2')->nullable()->constrained('persons')->onDelete('set null');
            $table->foreignId('relationship_type_id')->constrained('relationship_types')->onDelete('restrict');
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by')->constrained('users')->onDelete('restrict');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('relationships');
    }
}
