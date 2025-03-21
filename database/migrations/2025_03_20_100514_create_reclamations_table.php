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
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id()->change();
            $table->string('description');
            $table->string('titre');
            $table->date('date_creation')->default(DB::raw('CURRENT_TIMESTAMP'))->change();            $table->date('date_update');
            $table->string('statut')->default('en cours');
            $table->unsignedBigInteger('utilisateur_id')->nullable(); 
            $table->unsignedBigInteger('type_reclamations_id')->nullable(); 
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurs')->onDelete('set null');
            $table->foreign('type_reclamations_id')->references('id')->on('type_reclamations')->onDelete('set null');
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
        Schema::dropIfExists('reclamations');
    }
};
