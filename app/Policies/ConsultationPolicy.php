<?php

namespace App\Policies;

use App\Models\Consultation;
use App\Models\User;

class ConsultationPolicy
{
    public function before(User $user): ?bool
    {
        if ($user->hasRole('Administrateur')) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->hasRole(['Médecin', 'Infirmier']);
    }

    public function view(User $user, Consultation $consultation): bool
    {
        if ($user->hasRole('Médecin')) {
            return $consultation->patient->patientResponsables()->where('user_id', $user->id)->exists() 
                || $consultation->user_id === $user->id;
        }
        
        if ($user->hasRole('Infirmier')) {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Médecin');
    }

    public function update(User $user, Consultation $consultation): bool
    {
        return $user->hasRole('Médecin') && $consultation->user_id === $user->id;
    }

    public function delete(User $user, Consultation $consultation): bool
    {
        return false; 
    }
}