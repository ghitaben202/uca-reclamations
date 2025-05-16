<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Sauvegarder les données existantes
        $reclamations = DB::table('reclamations')->get();
        
        // Supprimer la colonne description
        Schema::table('reclamations', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        // Recréer la colonne en tant que TEXT
        Schema::table('reclamations', function (Blueprint $table) {
            $table->text('description')->after('titre');
        });

        // Restaurer les données
        foreach ($reclamations as $reclamation) {
            DB::table('reclamations')
                ->where('id', $reclamation->id)
                ->update(['description' => $reclamation->description]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Sauvegarder les données existantes
        $reclamations = DB::table('reclamations')->get();
        
        // Supprimer la colonne description
        Schema::table('reclamations', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        // Recréer la colonne en tant que STRING
        Schema::table('reclamations', function (Blueprint $table) {
            $table->string('description')->after('titre');
        });

        // Restaurer les données
        foreach ($reclamations as $reclamation) {
            DB::table('reclamations')
                ->where('id', $reclamation->id)
                ->update(['description' => $reclamation->description]);
        }
    }
};
