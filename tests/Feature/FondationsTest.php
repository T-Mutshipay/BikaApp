<?php

namespace Tests\Feature;

use App\Models\Consultation;
use App\Models\Departement;
use App\Models\Facturation;
use App\Models\Hospitalisation;
use App\Models\Patient;
use App\Models\Room;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FondationsTest extends TestCase
{
    use RefreshDatabase;

    private function service(): Service
    {
        $departement = Departement::create(['nom' => 'Médecine Interne']);

        return Service::create(['nom' => 'Cardiologie', 'departement_id' => $departement->id]);
    }

    private function donneesAdmission(Patient $patient, Room $room, Service $service, array $extra = []): array
    {
        return array_merge([
            'patient_id' => $patient->id,
            'service_id' => $service->id,
            'room_id' => $room->id,
            'date_admission' => now()->subDays(2)->toDateString(),
        ], $extra);
    }

    public function test_les_visiteurs_non_connectes_sont_redirigés(): void
    {
        $this->get('/patients')->assertRedirect('/login');
        $this->get('/factures')->assertRedirect('/login');
    }

    public function test_creation_de_patient_valide_et_refus_des_donnees_invalides(): void
    {
        $this->actingAs(User::factory()->create());

        $valide = [
            'nom' => 'Mutombo', 'prenom' => 'Anna', 'date_naissance' => '1990-05-10',
            'genre' => 'Féminin', 'adresse' => 'Gombe, Kinshasa',
            'telephone' => '+243 810 000 000', 'email' => 'anna@example.com',
        ];

        $this->post('/patients', $valide)->assertRedirect(route('patients.index'));
        $this->assertDatabaseHas('patients', ['email' => 'anna@example.com']);

        $this->post('/patients', array_merge($valide, ['email' => 'autre@example.com', 'genre' => 'Autre']))
            ->assertSessionHasErrors('genre');
        $this->post('/patients', array_merge($valide, ['date_naissance' => now()->addYear()->toDateString(), 'email' => 'x@example.com']))
            ->assertSessionHasErrors('date_naissance');
    }

    public function test_la_modification_d_un_patient_accepte_son_propre_email(): void
    {
        $this->actingAs(User::factory()->create());
        $patient = Patient::factory()->create();

        $this->put("/patients/{$patient->id}", [
            'nom' => 'Nouveau', 'prenom' => $patient->prenom, 'date_naissance' => '1985-01-01',
            'genre' => 'Masculin', 'adresse' => 'Lemba', 'telephone' => '0810000000',
            'email' => $patient->email,
        ])->assertSessionHasNoErrors();

        $this->assertSame('Nouveau', $patient->fresh()->nom);
    }

    public function test_une_consultation_valide_est_enregistree_avec_le_medecin_connecte(): void
    {
        $medecin = User::factory()->create();
        $patient = Patient::factory()->create();
        $this->actingAs($medecin);

        $this->post("/consultations/{$patient->id}", [
            'motif_consultation' => 'Fièvre', 'poids' => 70, 'taille' => 175,
            'temperature' => 38.5, 'tension' => 120, 'pouls' => 80, 'diagnostic' => 'Paludisme',
        ])->assertSessionHasNoErrors();

        $this->assertDatabaseHas('consultations', ['patient_id' => $patient->id, 'user_id' => $medecin->id]);
    }

    public function test_une_consultation_avec_des_constantes_aberrantes_est_refusee(): void
    {
        $this->actingAs(User::factory()->create());
        $patient = Patient::factory()->create();

        $this->post("/consultations/{$patient->id}", [
            'motif_consultation' => 'Test', 'poids' => -50, 'taille' => 175,
            'temperature' => 900, 'tension' => 120, 'pouls' => 80, 'diagnostic' => 'x',
        ])->assertSessionHasErrors(['poids', 'temperature']);

        $this->assertSame(0, Consultation::count());
    }

    public function test_une_chambre_pleine_refuse_une_nouvelle_admission(): void
    {
        $this->actingAs(User::factory()->create());
        $service = $this->service();
        $room = Room::factory()->create(['capacite' => 1, 'disponibilite' => true]);
        [$a, $b] = [Patient::factory()->create(), Patient::factory()->create()];

        $this->post('/hospitalisations', $this->donneesAdmission($a, $room, $service))
            ->assertSessionHasNoErrors();
        $this->assertFalse($room->fresh()->disponibilite);

        $this->post('/hospitalisations', $this->donneesAdmission($b, $room, $service))
            ->assertSessionHasErrors('room_id');
        $this->assertSame(1, Hospitalisation::count());
    }

    public function test_la_sortie_d_un_patient_libere_la_chambre(): void
    {
        $this->actingAs(User::factory()->create());
        $service = $this->service();
        $room = Room::factory()->create(['capacite' => 1, 'disponibilite' => true]);
        $patient = Patient::factory()->create();

        $this->post('/hospitalisations', $this->donneesAdmission($patient, $room, $service));
        $hospitalisation = Hospitalisation::firstOrFail();
        $this->assertFalse($room->fresh()->disponibilite);

        $this->put("/hospitalisations/{$hospitalisation->id}", $this->donneesAdmission($patient, $room, $service, [
            'date_sortie' => now()->subDay()->toDateString(),
        ]))->assertSessionHasNoErrors();

        $this->assertTrue($room->fresh()->disponibilite);
        $this->assertNotNull($hospitalisation->fresh()->date_sortie);
    }

    public function test_un_patient_ne_peut_pas_avoir_deux_hospitalisations_en_cours(): void
    {
        $this->actingAs(User::factory()->create());
        $service = $this->service();
        [$r1, $r2] = [Room::factory()->create(['capacite' => 2]), Room::factory()->create(['capacite' => 2])];
        $patient = Patient::factory()->create();

        $this->post('/hospitalisations', $this->donneesAdmission($patient, $r1, $service))
            ->assertSessionHasNoErrors();
        $this->post('/hospitalisations', $this->donneesAdmission($patient, $r2, $service))
            ->assertSessionHasErrors('patient_id');
    }

    public function test_une_chambre_avec_historique_ne_peut_pas_etre_supprimee(): void
    {
        $this->actingAs(User::factory()->create());
        $service = $this->service();
        $room = Room::factory()->create(['capacite' => 2]);
        $this->post('/hospitalisations', $this->donneesAdmission(Patient::factory()->create(), $room, $service));

        $this->delete("/rooms/{$room->id}")->assertSessionHas('error');
        $this->assertDatabaseHas('rooms', ['id' => $room->id]);
    }

    public function test_facturation_validation_et_binding_des_routes(): void
    {
        $this->actingAs(User::factory()->create());
        $patient = Patient::factory()->create();

        $this->post('/factures', ['patient_id' => $patient->id, 'montant_total' => 'abc', 'statut' => 'Inconnu'])
            ->assertSessionHasErrors(['montant_total', 'statut']);

        $this->post('/factures', ['patient_id' => $patient->id, 'montant_total' => 150.50, 'statut' => 'En attente'])
            ->assertSessionHasNoErrors();
        $facture = Facturation::firstOrFail();

        // Régression : le paramètre de route doit se lier au bon modèle (et pas à un modèle vide).
        $this->get("/factures/{$facture->id}")->assertOk();
        $this->put("/factures/{$facture->id}", ['patient_id' => $patient->id, 'montant_total' => 200, 'statut' => 'Payée'])
            ->assertSessionHasNoErrors();
        $this->assertSame('Payée', $facture->fresh()->statut);

        $this->delete("/factures/{$facture->id}");
        $this->assertDatabaseMissing('facturations', ['id' => $facture->id]);
    }

    public function test_la_page_services_exige_un_departement_existant(): void
    {
        $this->actingAs(User::factory()->create());
        $service = $this->service();

        $this->get("/services?departement={$service->departement_id}")->assertOk();
        $this->get('/services?departement=9999')->assertNotFound();
    }
}
