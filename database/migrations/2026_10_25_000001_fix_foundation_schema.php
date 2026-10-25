<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Corrections de schéma identifiées lors de l'audit (étape 1) :
 *  - patient_responsables.user_id était un string, sans vraie clé étrangère ;
 *  - examens.result (255 caractères) est trop court pour un résultat médical ;
 *  - index pour calculer rapidement l'occupation des chambres.
 *
 * Attention : si patient_responsables contient des user_id qui ne
 * correspondent à aucun utilisateur, l'ajout de la clé étrangère échouera.
 * Nettoie ces lignes avant de migrer.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patient_responsables', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
        });

        // SQLite (utilisé pour les tests) ne sait pas ajouter une clé
        // étrangère sur une table existante ; MySQL/MariaDB/PostgreSQL oui.
        if (DB::getDriverName() !== 'sqlite') {
            Schema::table('patient_responsables', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            });
        }

        Schema::table('examens', function (Blueprint $table) {
            $table->text('result')->change();
        });

        Schema::table('hospitalisations', function (Blueprint $table) {
            $table->index(['room_id', 'date_sortie'], 'hospitalisations_room_sortie_index');
            $table->index('service_id');
        });
    }

    public function down(): void
    {
        Schema::table('hospitalisations', function (Blueprint $table) {
            $table->dropIndex('hospitalisations_room_sortie_index');
            $table->dropIndex(['service_id']);
        });

        Schema::table('examens', function (Blueprint $table) {
            $table->string('result')->change();
        });

        if (DB::getDriverName() !== 'sqlite') {
            Schema::table('patient_responsables', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        Schema::table('patient_responsables', function (Blueprint $table) {
            $table->string('user_id')->change();
        });
    }
};
