<?php

// Démonstration 01 - Introduction


// 1.  Programmation fonctionnelle vs OO

// 1.1. Programmation fonctionnelle

$eleve1_nom = "Doe";
$eleve1_prenom = "Jane";
$eleve1_notes = [12, 14, 8, 15];

$eleve2_nom = "Doe";
$eleve2_prenom = "John";
$eleve2_notes = [12, 14, 8, 15];

function moyenne (array $notes): float {
  return array_sum($notes) / count($notes);
}

$eleve1_moyenne = moyenne($eleve1_notes);
$eleve2_moyenne = moyenne($eleve2_notes);

// 1.2. Programmation orienté objet

class Eleve {
  // Attributs (= caractéristiques)
  public string $nom;
  public string $prenom;
  public array $notes;

  // Méthodes (= comportements)
  function moyenne(): float {
    return array_sum($this->notes) / count($this->notes);
  }
}

$eleve1 = new Eleve();
$eleve1->nom = "Doe";
$eleve1->prenom = "John";
$eleve1->notes = [14, 12, 10, 13];
echo "Moyenne de l'élève 1: " . $eleve1->moyenne() . "<br>";

$eleve2 = new Eleve();
$eleve2->nom = "Doe";
$eleve2->prenom = "Jane";
$eleve2->notes = [14, 12, 10, 13];
echo "Moyenne de l'élève 2: " . $eleve2->moyenne() . "<br>";


?>