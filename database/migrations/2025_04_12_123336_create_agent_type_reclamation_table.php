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
        Schema::create('agent_type_reclamation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->nullable();  
            $table->unsignedBigInteger('type_reclamation_id')->nullable();
            $table->timestamps();
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('set null');
            $table->foreign('type_reclamation_id')->references('id')->on('type_reclamations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_type_reclamation');
    }
};
