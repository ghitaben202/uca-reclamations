<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function createTestAgent()
    {
        try {
            $agent = new Agent();
            $agent->nom = 'Test';
            $agent->prenom = 'Agent';
            $agent->username = 'testagent';
            $agent->password = 'test123';
            $agent->type_reclamations_id = 1;
            $agent->save();

            return response()->json([
                'success' => true,
                'message' => 'Agent créé avec succès',
                'agent' => $agent
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de l\'agent',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 