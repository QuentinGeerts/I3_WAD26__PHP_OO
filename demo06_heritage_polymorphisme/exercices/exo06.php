<?php

class Vehicule {

  // Attributs

  // Constructeur
  public function __construct(protected string $marque, protected int $vitesseMax) { }

  // Getters / Setters
  public function getMarque(): string 
  {
    return $this->marque;
  }

  // Méthodes
  public function decrire(): string 
  {
    return "{$this->marque} - vitesse maximum: {$this->vitesseMax} km/h.";
  }

  public function demarrer(): string 
  {
    return "Le véhicule démarre.";
  }

}

class Voiture extends Vehicule {

  public function __construct(string $marque, int $vitesseMax, private int $nbPortes)
  {
    parent::__construct($marque, $vitesseMax);
    // $this->marque = "test"; // Access
  }

  public function demarrer(): string
  {
    return "Vroum ! La voiture démarre.";
  }

  public function klaxonner(): string 
  {
    return "Tuuut !";
  }

}

class Velo extends Vehicule {

  public function __construct(string $marque, int $vitesseMax)
  {
    parent::__construct($marque, $vitesseMax);
  }

  public function demarrer(): string
  {
    return "Un coup de pédale et c'est parti !";
  }

}

$voiture = new Voiture("Kia", 240, 5);
$velo = new Velo("Btwin", 30);

$vehicules = [
  $voiture,
  $velo,
  new Voiture("BMW", 260, 5)
]

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Exercice 06 - Héritage et polymorphisme</h1>

  <?php
  
  echo $voiture instanceof Voiture . "<br>";
  echo $velo instanceof Voiture . "<br>";
  
  ?>

  <ul>
  <?php foreach($vehicules as $vehicule): ?>

    <li><?= $vehicule->decrire() . $vehicule->demarrer() . ($vehicule instanceof Voiture ? $vehicule->klaxonner() : "") ?></li>

  <?php endforeach ?>
  </ul>
</body>

</html>