<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cahiercharges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_id');
            $table->enum('duree_contrat', [
                'Sans Engagement',
                '12 mois',
                '24 mois',
                '36 mois',
            ]);
            $table->enum('energie_verte', ['Oui', 'Non']);
            $table->boolean('encouter_les_opportunites');
            $table->enum('frequence_facturation', [
                'Mensuelle',
                'Biimensuelle',
                'Trimensuelle',
                'Annuelle',
            ]);
            $table->enum('type_offre', [
                'Prix fix 100% marché',
                'Prix indexé ARENH',
            ]);
            $table->enum('mode_paiement', [
                'Prélevement Bancaire',
                'Virement Bancaire',
                'Chéque',
                'Carte Banciare',
            ]);
            $table->enum('offre_fournisseur', [
                'Offre à titre indicative',
                'Offre réel et fermé',
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cahiercharges');
    }
};
