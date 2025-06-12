<?php

namespace App\Models;

use CodeIgniter\Model;

class MarqueModel extends Model
{
    protected $table = 'marque';
    protected $primaryKey = 'id_marque';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nomm','logo'];

    public function ajouterMarque(array $donnees): bool
    {
        try {
            return $this->insert($donnees);
        } catch (\Exception $e) {
            log_message('error', 'Erreur lors de l\'ajout de la marque : ' . $e->getMessage());
            return false;
        }
    }

    public function listeToutesLesMarques(): array
    {
        return $this->asObject()->findAll();
    }


    public function obtenirUneMarque(int $id_marque): ?object
    {
        $resultat = $this->where('id_marque', $id_marque)->first();
        return $resultat ? (object) $resultat : null;
    }

    public function supprimerMarque(int $id_marque): bool
    {
        if ($this->find($id_marque) === null) {
            return false;
        }
        return $this->delete($id_marque);
    }

    public function mettreAJourMarque(int $id_marque, array $donnees): bool

    {
        try {
            return $this->update($id_marque, $donnees); 
        } catch (\Exception $e) {
            log_message('error', 'Erreur lors de la mise à jour de l\'âge: ' . $e->getMessage());
            return false;
        }
    }


}
