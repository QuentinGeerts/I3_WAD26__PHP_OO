<?php

class Livre {

  public function __construct(
    public string $titre, 
    public string $auteur, 
    public int $nbPages, 
    public float $prix = 0
  ) { }

  public function decrire(): string {
    return sprintf("%s de %s - %d pages - %.2f €", $this->titre, $this->auteur, $this->nbPages, $this->prix);
  }

  public function estGros(): bool {
    return $this->nbPages >= 300;
  }

  public function appliquerReduction(float $pourcentage): float {
    return $this->prix * (1 - $pourcentage);
  }
}

// - « Le Petit Prince », de Saint-Exupéry, 96 pages, 7.90 €
// - « 1984 », de George Orwell, 328 pages, 9.50 €

$livre1 = new Livre("Le Petit Prince", "Saint-Exupéry", 96, 7.9);
$livre2 = new Livre("1984", "George Orwell", 328, 9.5);

$livres = [$livre1, $livre2];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <h1>Exercice 04 - La classe Livre (Constructeur)</h1>

  <table>
    <thead>
      <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Nombre de pages</th>
        <th>Prix</th>
        <th>Décrire</th>
        <th>Réduction</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($livres as $livre) : ?>
      <tr>
        <td><?= $livre->titre ?></td>
        <td><?= $livre->auteur ?></td>
        <td><?= $livre->nbPages ?></td>
        <td><?= $livre->prix ?></td>
        <td><?= $livre->decrire() ?></td>
        <td><?= $livre->appliquerReduction(0.5) ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>

</body>

</html>