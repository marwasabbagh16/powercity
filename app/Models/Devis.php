<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    protected $table = 'devis';
    
    protected $fillable = [
        'reference',
        'client_name',
        'client_email', 
        'client_company',
        'message',
        'statut',
    ];
}
