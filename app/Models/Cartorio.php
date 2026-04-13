<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cartorio extends Model
{

// Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome', 
        'cnpj', 
        'nome_tabeliao', 
        'ativo', 
        'municipio_id'
    ];

  
    // Define a relação de um cartório pertencente  a um município
    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}