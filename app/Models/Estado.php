<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados'; 
    protected $fillable = ['nome', 'uf'];

    
    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }
}