<?php

// 1.  Classe mère
class Animal {
  public function __construct(public string $nom) { }

  public function crier(): string {
    return "{$this->nom} fait un cri générique";
  }
}

// 2.  Classe fille + redéfinition de méthode
class Poule extends Animal {
  // Redéfinition de méthode (polymorphisme)
  public function crier(): string
  {
    return "{$this->nom} fait Cot-Cot !";
  }
}

// 3.  Classe fille + appel du constructeur parent + attribut du poisson
class Poisson extends Animal {

  public function __construct(string $nom, public string $couleur)
  {
    parent::__construct($nom);
  }

  public function crier(): string
  {
    return parent::crier() . " mais de poisson";
  }
}

// 4.  Héritage sur plusieurs niveaux
class PoissonChirurgien extends Poisson {

  public function __construct(string $nom, string $couleur)
  {
    return parent::__construct($nom, $couleur);
  }

  public function crier(): string
  {
    return "{$this->nom} Nage droit devant toi !";
  }

}

// 5.  Héritage multiple interdit
// → Solution: Interface (chapitre suivant)
class Carnivore {

}

class Herbivore {
  
}

// class Omnivore extends Carnivore, Herbivore {

// }

class Zoo {
  public function __construct(private array $animaux = []) { }

  public function ajouter_animal(Animal $animal): void {
    array_push($this->animaux, $animal);
  }

  public function decrire(): string {
    $str = "<ul>";
    foreach($this->animaux as $animal) {
      $str = $str . "<li>{$animal->nom}</li>";
    }
    $str .= "</ul>";
    return $str;
  }

  public function getAnimal(int $index): Animal {
    if ($index < 0 || $index >= count($this->animaux)) 
      throw new OutOfBoundsException("L'index doit être entre 0 et " . count($this->animaux));
    return $this->animaux[$index];
  }
}


$animal = new Animal("Felix");
$poule = new Poule("Tilly");
$poisson = new Poisson("Wanda", "bleu");

$zoo = new Zoo();

// Polymorphisme
// → Un animal est un animal
// → Une poule est un animal
// → Un poisson est un animal
// → Un poisson chirurgien est un poisson qui est un animal
$zoo->ajouter_animal($animal);
$zoo->ajouter_animal($poule);
$zoo->ajouter_animal($poisson);
$zoo->ajouter_animal(new PoissonChirurgien("Dori", "bleu"));

$a1 = $zoo->getAnimal(2);

// PHP n'a pas de cast de classe : on teste le type réel avec instanceof
if ($a1 instanceof Poisson) {
  $couleur = $a1->couleur;
} else {
  $couleur = "inconnue";
}

echo $couleur;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Démonstration 06 - Héritage & Polymorphisme</h1>

  <p>Animal crie: <?= $animal->crier() ?></p>
  <p>Poule: <?= $poule->nom ?></p>
  <p>Poule: <?= $poule->crier() ?></p>
  <p>Poisson: <?= $poisson->crier() ?></p>

  <?= $zoo->decrire() ?>

</body>

</html>