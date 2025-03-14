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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email_academique');
            $table->string('telephone');
            $table->string('cne')->nullable();;
            $table->string('num_apogee')->nullable();;
            $table->date('date_naissance')->nullable();;
            $table->string('email_personnel')->nullable();;
            $table->string('mot_de_passe');
            $table->unsignedBigInteger('ced_id')->nullable(); 
            $table->unsignedBigInteger('lab_id')->nullable(); 
            $table->unsignedBigInteger('role_id')->nullable(); 
            $table->unsignedBigInteger('etablissement_id')->nullable(); 
            $table->foreign('ced_id')->references('id')->on('ced')->onDelete('set null');
            $table->foreign('lab_id')->references('id')->on('laboratoires')->onDelete('set null');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null'); 
            $table->foreign('etablissement_id')->references('id')->on('etablissements')->onDelete('set null');   
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
        Schema::dropIfExists('utilisateurs');
    }
};
