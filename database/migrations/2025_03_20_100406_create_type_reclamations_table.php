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
        Schema::create('type_reclamations', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->id()->change();
            $table->string('nom');
            $table->string('description');
            $table->timestamps();
        });
    
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types_reclamations');
    }
};
