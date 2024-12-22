<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'date',
        'statut',
        'priorite',
        'perte_temps',
        'gain_temps',
        'motif',
        'user_id',
        
    ];
    
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
