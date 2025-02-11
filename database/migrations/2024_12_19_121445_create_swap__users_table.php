<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwapUsersTable extends Migration
{
    /**
     * Exécutez la migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swap_users', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('nom');   
            $table->string('prenom');    
            $table->string('phone')->unique();  // Téléphone (avec unicité)
            $table->string('ville');      
            $table->string('quartier'); 
            $table->string('password'); 
            $table->string('photo')->nullable(); 
            $table->foreignId('agency_id')->constrained('agences')->onDelete('cascade'); 
            $table->timestamps();  
        });
    }

    /**
     * Annulez la migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('swap_users');
    }
}
