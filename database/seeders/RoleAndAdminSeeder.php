<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RoleAndAdminSeeder extends Seeder
{
    public function run(): void
    {
     
        $roles = ['Administrateur', 'Médecin', 'Infirmier', 'Caissier'];
        
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $motDePasseClair = Str::password(16);

        $admin = User::firstOrCreate(
            ['email' => 'admin@cuk.cd'],
            [
                'name' => 'Administrateur Système',
                'telephone' => '+243000000000',
                'specialite' => 'Informatique',
                'password' => Hash::make($motDePasseClair),
            ]
        );

        // On lui attribue le rôle
        $admin->assignRole('Administrateur');

        // 3. Affichage du mot de passe dans la console (uniquement lors du seed)
        $this->command->info('==================================================');
        $this->command->info('COMPTE ADMINISTRATEUR CRÉÉ AVEC SUCCÈS !');
        $this->command->info('Email : admin@cuk.cd');
        $this->command->info('Mot de passe : ' . $motDePasseClair);
        $this->command->warn('NOTEZ CE MOT DE PASSE ET CHANGEZ-LE DÈS LA CONNEXION.');
        $this->command->info('==================================================');
    }
}