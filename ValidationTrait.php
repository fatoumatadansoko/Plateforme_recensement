<?php
trait ValidationTrait {
    public function validateNom($nom) {
        // Expression régulière pour les noms
        $pattern = '/^[A-Za-z\-\' ]+$/';
        return preg_match($pattern, $nom);
    }

    public function validatePrenom($prenom) {
        // Expression régulière pour les prénoms
        $pattern = '/^[A-Za-z ]+$/';
        return preg_match($pattern, $prenom);
    }
    
}

