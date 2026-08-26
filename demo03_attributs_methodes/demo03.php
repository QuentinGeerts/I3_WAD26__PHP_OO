<?php

/*
  Démonstration 03 - Les attributs / méthodes
*/

class CompteurDeVues {

  // Attributs (caractéristiques)
  public string $page;
  public int $compteur = 0; // Déclaration + initialisation

  // Méthodes

  // Procédure: ne retourne aucune valeur => void
  public function ajouterUneVue(): void {
    // $this->compteur = $this->compteur + 1;
    // $this->compteur += 1;
    $this->compteur++;
  }

  public function ajouterPlusieursVues(int $number = 10): void {
    // if ($number > 0) {
    //   $this->compteur += $number;
    // }
    // else {
    //   return;
    // }

    // Fail Fast Pattern
    if ($number <= 0) return;
    $this->compteur += $number;
  }

  // Fonction: Retourne une valeur => type
  public function est_populaire(): bool {
    // if ($this->compteur >= 100)
    //   return true;
    // else
    //   return false;
    return $this->compteur >= 100;
  }

  // Méthode qui appelle une autre méthode définie dans la classe
  public function resumer(): string {
    $etat = $this->est_populaire() ? "populaire" : "non populaire";
    return "[$etat] La page " . $this->page . " a " . $this->compteur . " vue(s)";
  }
}

$accueil = new CompteurDeVues();
$accueil->page = "/accueil";

echo $accueil->resumer() . "<br>";

$accueil->ajouterUneVue();

echo $accueil->resumer() . "<br>";

$accueil->ajouterPlusieursVues();

echo $accueil->resumer() . "<br>";

$accueil->ajouterPlusieursVues(151);

echo $accueil->resumer() . "<br>";

