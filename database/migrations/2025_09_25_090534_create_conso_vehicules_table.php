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
        // Table des véhicules
        Schema::create('conso_vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('immatriculation')->unique();
            $table->string('marque');
            $table->string('nom');
            $table->string('numero_chassis')->nullable();
            $table->date('date_achat')->nullable();
            $table->decimal('conso_moyenne', 5, 2)->comment('Litres / 100 km');
            $table->string('type_moteur');
            $table->string('type_carburant');
            // $table->integer('kilometrage_actuel')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });


        // Table des missions
        Schema::create('conso_missions', function (Blueprint $table) {
            $table->id();
            $table->string('objet');
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->text('description')->nullable();
            $table->string('lieu');
            $table->enum('type_mission', ['longue_duree', 'course_ville']);
            $table->enum('etat', ['en_cours', 'suspendu', 'termine'])->default('en_cours');
            $table->string('chauffeur')->nullable();
            $table->string('chef_mission')->nullable();
            $table->string('projet')->nullable();
            $table->unsignedBigInteger('vehicule_id');
            $table->timestamps();
        });


        // Table des consommations/carburants mission
        Schema::create('conso_carburants_mission', function (Blueprint $table) {
            $table->id();
            $table->integer('kilometrage_depart');
            $table->decimal('montant_carburant_remis', 10, 2);
            $table->date('date_remise');
            $table->string('image_kilometrage_depart')->nullable();
            $table->string('remis_par');
            $table->enum('observation', ['ticket_valeur', 'espece', 'momo'])->default('ticket_valeur');
            $table->unsignedBigInteger('mission_id');
            $table->timestamps();
        });


        // Table des points de fin de mission
        Schema::create('conso_points_fins_missions', function (Blueprint $table) {
            $table->id();
            $table->date('date_retour');
            $table->integer('kilometrage_arrivee');
            $table->string('image_kilometrage_arrive')->nullable();
            $table->decimal('montant_restant', 10, 2)->default(0);
            $table->unsignedBigInteger('mission_id');
            $table->timestamps();
        });


        // Table des types de carburants
        Schema::create('conso_type_carburants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->decimal('prix_station', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conso_type_carburants');
        Schema::dropIfExists('conso_points_fins_missions');
        Schema::dropIfExists('conso_carburants_mission');
        Schema::dropIfExists('conso_missions');
        Schema::dropIfExists('conso_vehicules');
    }
};
