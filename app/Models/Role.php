<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['nom']; // Ajuste en fonction de ta migration

    public function typeReclamations()
    {
        return $this->hasMany(typeReclamation::class, 'role_id');
    }
}
