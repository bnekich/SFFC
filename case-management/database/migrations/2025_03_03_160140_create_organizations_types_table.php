<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTypesTable extends Migration
{
    public function up()
    {
        Schema::create('organization_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organization_types');
    }
}