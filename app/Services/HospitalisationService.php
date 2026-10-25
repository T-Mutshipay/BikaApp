<?php

namespace App\Services;

use App\Models\Hospitalisation;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Règles métier des hospitalisations : capacité des chambres, un seul séjour
 * actif par patient, et synchronisation de la disponibilité des chambres.
 * Tout se fait dans une transaction avec verrou sur les chambres, pour éviter
 * que deux admissions simultanées dépassent la capacité.
 */
class HospitalisationService
{
    public function admettre(array $data): Hospitalisation
    {
        return DB::transaction(function () use ($data) {
            $room = Room::lockForUpdate()->findOrFail($data['room_id']);

            $this->verifierAdmission($room, (int) $data['patient_id']);

            $hospitalisation = Hospitalisation::create($data);
            $room->refreshDisponibilite();

            return $hospitalisation;
        });
    }

    public function modifier(Hospitalisation $hospitalisation, array $data): Hospitalisation
    {
        return DB::transaction(function () use ($hospitalisation, $data) {
            $ids = array_values(array_unique([$hospitalisation->room_id, (int) $data['room_id']]));
            sort($ids); // ordre stable des verrous, pour éviter les deadlocks

            $rooms = Room::whereIn('id', $ids)->orderBy('id')->lockForUpdate()->get()->keyBy('id');
            $nouvelleChambre = $rooms[(int) $data['room_id']];

            $this->verifierAdmission($nouvelleChambre, (int) $data['patient_id'], $hospitalisation->id);

            $hospitalisation->update($data);
            $rooms->each->refreshDisponibilite();

            return $hospitalisation;
        });
    }

    public function supprimer(Hospitalisation $hospitalisation): void
    {
        DB::transaction(function () use ($hospitalisation) {
            $room = Room::lockForUpdate()->find($hospitalisation->room_id);

            $hospitalisation->delete();
            $room?->refreshDisponibilite();
        });
    }

    private function verifierAdmission(Room $room, int $patientId, ?int $ignorerId = null): void
    {
        if ($room->occupation($ignorerId) >= $room->capacite) {
            throw ValidationException::withMessages([
                'room_id' => "La chambre « {$room->nom} » est pleine.",
            ]);
        }

        $dejaHospitalise = Hospitalisation::active()
            ->where('patient_id', $patientId)
            ->when($ignorerId, fn ($q) => $q->where('id', '!=', $ignorerId))
            ->exists();

        if ($dejaHospitalise) {
            throw ValidationException::withMessages([
                'patient_id' => 'Ce patient a déjà une hospitalisation en cours.',
            ]);
        }
    }
}
