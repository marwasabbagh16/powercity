<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'reference', 'libelle', 'marque', 'description', 'category_id', 
    'image', 'datasheet', 'topologie', 'puissance', 'rendement', 'configuration','featured',
];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('libelle', 'like', "%{$term}%")
                     ->orWhere('reference', 'like', "%{$term}%")
                     ->orWhere('marque', 'like', "%{$term}%");
    }
}