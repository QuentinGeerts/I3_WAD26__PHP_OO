<?php

/*
  ## Exercice 02 - La classe Ordinateur

  1. Créez une classe `Ordinateur` contenant une seule propriété publique : `$marque` (une chaîne de caractères).
  2. Ajoutez-lui une méthode `presenter()` qui retourne la phrase : "Cet ordinateur est un <marque>."
  3. Dans le programme principal, créez deux objets :
  - le premier de marque "Dell"
  - le second de marque "Asus"
  4. Affichez la présentation de chacun.

  Résultat attendu à l'écran :
  ```txt
  Cet ordinateur est un Dell.
  Cet ordinateur est un Asus.
  ```
*/

// 1.  Déclaration du modèle d'un ordinateur
class Ordinateur {
  // Attributs
  public string $marque;

  // Méthodes
  public function presenter(): string {
    return "Ceci est un " . $this->marque;
  }
}

// 2.  Création des objets basés sur le modèle Ordinateur
$pc1 = new Ordinateur();
$pc2 = new Ordinateur();

// 3.  Initialiser les valeurs des objets
$pc1->marque = "Dell";
$pc2->marque = "Asus";

// 4.  Afficher la présentation de chaque PC
echo $pc1->presenter() . "<br>";
echo $pc2->presenter() . "<br>";

