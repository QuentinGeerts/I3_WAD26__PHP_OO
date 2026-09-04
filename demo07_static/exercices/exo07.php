<?php

class Article
{
  // Attributs / Constantes
  public const TVA = 0.21;
  private static int $nombre = 0;

  // Constructeur
  public function __construct(public string $nom, public float $prixHT) {
    self::$nombre ++;
  }

  // Méthodes
  public function prixTTC(): float
  {
    return $this->prixHT * (1 + self::TVA);
  }
  
  public static function getNombre(): int
  {
    return self::$nombre;
  }
}

$articles = [
  new Article("Ordinateur portable DELL", 699),
  new Article("Sandiwch", 4.5),
  new Article("Voiture KIA Ceed GT-Line", 16_500.99)
];

$totalTTC = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Exercice 07 - Le mot-clef "static"</h1>

  <table>
    <thead>
      <th>Nom</th>
      <th>Prix HT</th>
      <th>Prix TTC</th>
    </thead>
    <tbody>
      <?php foreach($articles as $a): ?>
        <?php $totalTTC += $a->prixTTC() ?>
      <tr>
        <td><?= $a->nom ?></td>
        <td><?= $a->prixHT ?></td>
        <td><?= $a->prixTTC() ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">Total des <?= Article::getNombre() ?> articles :</td>
        <td><?= $totalTTC ?> €</td>
      </tr>
    </tfoot>
  </table>

    
</body>
</html>
