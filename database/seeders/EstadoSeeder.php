<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
 
    public function run(): void
    {
      \App\Models\Municipio::query()->delete();
    \App\Models\Estado::query()->delete();

 
    $go = \App\Models\Estado::create(['nome' => 'Goiás', 'uf' => 'GO']);
    $mg = \App\Models\Estado::create(['nome' => 'Minas Gerais', 'uf' => 'MG']);

   
    \App\Models\Municipio::create(['nome' => 'Novo Gama', 'estado_id' => $go->id]);
    \App\Models\Municipio::create(['nome' => 'Valparaíso de Goiás', 'estado_id' => $go->id]);
    \App\Models\Municipio::create(['nome' => 'Cidade Ocidental', 'estado_id' => $go->id]);
    
    \App\Models\Municipio::create(['nome' => 'Araguari', 'estado_id' => $mg->id]);
    \App\Models\Municipio::create(['nome' => 'Uberlândia', 'estado_id' => $mg->id]);
    \App\Models\Municipio::create(['nome' => 'Unaí', 'estado_id' => $mg->id]);
    
    }
}
