<?php
// src/Services/UsersServices.php

namespace App\Services;

use DateTimeImmutable;

class UsersServices {

    public function getInitiales(string $nom, string $prenom) : string {
        return substr($prenom, 0, 1) . substr($nom, 0, 1);
    }

    public function getAge(DateTimeImmutable $dateNaissance) : int {
        $today = new DateTimeImmutable();
        return $dateNaissance->diff($today)->y;
    }
}