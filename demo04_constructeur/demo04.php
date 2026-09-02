<?php

class Chaussette {
  public int $pointure_min;
  public int $pointure_max;
  public string $couleur;
  public string $matiere;
  public bool $est_propre = true;

  // Par défaut, il y a le constructeur "par défaut"
  // Si on ajoute notre propre constructeur
  // → Écraser le constructeur par défaut par le notre

  public function __construct(
    int $pointure_min, int $pointure_max, string $couleur,
    string $matiere, bool $est_propre = true
  )
  {
    $this->pointure_min = $pointure_min;
    $this->pointure_max = $pointure_max;
    $this->couleur = $couleur;
    $this->matiere = $matiere;
    $this->est_propre = $est_propre;
  }

}

$c1 = new Chaussette(41, 47, "blue", "coton", true);
// $c1->pointure_min = 41;
// $c1->pointure_max = 47;
// $c1->couleur = "bleu";
// $c1->matiere = "coton";
$c2 = new Chaussette(35, 40, "violet", "synthetique", false);
$c3 = new Chaussette(25, 30, "rouge", "coton")

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

</body>

</html>