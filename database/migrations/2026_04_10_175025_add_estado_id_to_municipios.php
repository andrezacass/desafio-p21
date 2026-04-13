<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::table('municipios', function (Blueprint $table) {
        
        $table->foreignId('estado_id')->after('id')->constrained('estados')->onDelete('cascade');
           
        });
    }

   
    public function down(): void
    {
        Schema::table('municipios', function (Blueprint $table) {
        // Para o caso de você precisar desfazer a migração
        $table->dropForeign(['estado_id']);
        $table->dropColumn('estado_id');
        
        });
    }
};
