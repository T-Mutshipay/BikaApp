# Étape 1 : Fondations (BikaApp)

## Appliquer les changements

```bash
git checkout -b etape-1-fondations
git apply etape1-fondations.patch      # ajoute, modifie ET supprime les fichiers
php artisan migrate                    # en dev : php artisan migrate:fresh --seed
php artisan test
```

Sans git : décompresser `etape1-fichiers.zip` à la racine du projet, puis supprimer
à la main les 9 fichiers `routes/web_*.php` (tout est maintenant dans `routes/web.php`).

> Aucune dépendance à installer. Un seul nouveau fichier de migration.
> Avant `migrate` sur des données existantes : toute ligne de `patient_responsables`
> dont `user_id` ne correspond à aucun utilisateur fera échouer l'ajout de la clé étrangère.

## Ce qui a été corrigé

### Bugs bloquants
| Problème | Correction |
|---|---|
| 10 vues manquantes (erreur 500) | Créées : patients, départements, chambres, hospitalisations, factures, responsables |
| `StoreFacturationRequest` / `UpdateFacturationRequest` inexistants, `->validated([...])` ne validait rien | Classes créées, règles réelles |
| Route facture : paramètre `facture` ≠ `$facturation` (modèle vide injecté) | `->parameters(['factures' => 'facturation'])` |
| `date_sorite` (faute) : la date de sortie n'était jamais enregistrée | Corrigé dans le modèle et les vues |
| `PatientController::create` : SQL brut sur une table inexistante | Supprimé |
| `HospitalisationController::index` : `$request->all(['service'])` (tableau) | `$request->integer('service')`, filtre optionnel |
| Route `services/{departementId}` en doublon et inatteignable | Supprimée, `ServiceController` simplifié (404 si département inconnu) |
| `DepartementController::show` : variable `$services` non définie | Corrigé |
| `DatabaseSeeder` : services insérés avant les départements (clé étrangère) | Ordre inversé |
| `UserFactory` sans `specialite`/`telephone` (colonnes obligatoires) | Ajoutés |
| `RoomFactory` : capacité 0 possible | `numberBetween(1, 6)` |

### Validation et sécurité des entrées
- Plus aucun `$request->all()` : tout passe par `FormRequest` + `validated()` (anti mass assignment).
- Constantes vitales bornées (température 25–45 °C, poids, taille, pouls, tension).
- Date de naissance non future, genre contrôlé, téléphone au format plausible.
- Statuts de facture limités à une liste (`Facturation::STATUTS`).
- Une chambre ayant un historique ne peut plus être supprimée (la cascade effaçait les hospitalisations).

### Logique des chambres (`app/Services/HospitalisationService.php`)
- Occupation = hospitalisations **en cours** seulement (avant : tous les séjours, même terminés).
- Transaction + verrou de ligne : deux admissions simultanées ne dépassent plus la capacité.
- `disponibilite` recalculée à partir de l'occupation réelle (plus de forçage à « occupée »).
- Nouvelle règle : un patient ne peut pas avoir deux hospitalisations en cours.
- Réduire la capacité d'une chambre sous son occupation actuelle est refusé.

### Structure
- 10 fichiers de routes fusionnés en un `routes/web.php`; routes inutiles retirées
  (`users` et `services` en lecture seule, `consultations` limité à `store`).
- Contrôleurs vides ou à moitié écrits nettoyés; route model binding partout.
- Modèles : relations typées, casts de dates (`Y-m-d`, JSON inchangé pour la recherche des patients), relation `consultations()` au pluriel.
- Migration `2026_10_25_000001_fix_foundation_schema.php` : `user_id` en entier + clé étrangère,
  `examens.result` en `text`, index sur les hospitalisations.
- `.env.example` décommenté (nom de l'app, fuseau `Africa/Kinshasa`); `phpunit.xml` en SQLite mémoire.

### Tests
- `tests/Feature/FondationsTest.php` : 11 tests (patients, consultations, capacité des chambres,
  sortie, double hospitalisation, factures, services).
- Tests Breeze d'origine alignés sur ton application (redirection vers `menu`, champs du compte).

## Limites connues (volontairement reportées)
- **Étape 2** : aucun rôle ni Policy; `/register` toujours ouvert; `authorize()` des FormRequest renvoie `true`; pas de `SoftDeletes` ni d'audit.
- **Étape 3** : pas de pagination; la tension est un seul nombre (systolique) car la colonne est `double`; les factures ne se rattachent pas encore à une consultation/hospitalisation depuis l'interface; le menu garde ses 4 départements codés en dur.
- Les messages de validation restent en anglais (traduction française à prévoir).
- Les nouvelles vues reprennent le style Breeze actuel; la refonte graphique est l'étape 5.
