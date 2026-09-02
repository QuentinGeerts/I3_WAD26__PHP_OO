<?php

class Rectangle {

  // Attributs
  public float $hauteur;
  public float $largeur;

  // Méthodes
  public function surface(): float {
    return $this->largeur * $this->hauteur;
  }

  public function perimetre(): float {
    return ($this->largeur + $this->hauteur) * 2;
  }

  public function estCarre(): bool {
    return $this->largeur === $this->hauteur;
  }

  // Rectangle 4x4 : surface = 16, périmètre = 16. C'est un carré !
  // Rectangle 5x3 : surface = 15, périmètre = 16. Ce n'est pas un carré.
  public function decrire(): string {
    return sprintf(
      "Rectangle %.2fx%.2f : surface = %.2f, périmètre = %.2f. %s", 
      $this->hauteur,
      $this->largeur,
      $this->surface(),
      $this->perimetre(),
      $this->estCarre() ? "C'est un carré !" : "Ce n'est pas un carré."
    );
  }
}

$r1 = new Rectangle();
$r2 = new Rectangle();

$r1->largeur = 4;
$r1->hauteur = 4;

$r2->largeur = 4;
$r2->hauteur = 5;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <h1>Exercice 3.1 - La classe Rectangle</h1>

  <p>Rectangle 1: <?php echo $r1->decrire() ?></p>
  <p>Rectangle 2: <?= $r2->decrire() ?></p>

</body>

</html>