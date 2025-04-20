<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        Agent::create([
            'nom' => 'Admin',
            'prenom' => 'Agent',
            'username' => 'admin',
            'password' => 'admin123',
            'type_reclamations_id' => 1
        ]);
    }
} 