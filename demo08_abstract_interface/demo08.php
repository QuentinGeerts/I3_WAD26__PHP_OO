<?php

/*
  Démonstration 08 - Le mot-clef 'abstract' et les interfaces
*/

interface Volant
{
  function decoller(): string;
  function atterir(): string;
}

interface Roulant
{
  function rouler(float $distance): string;
}

abstract class Vehicule
{
  public function __construct(public string $marque) {}

  public abstract function demarrer();

  public function decrire(): string
  {
    return "Marque: {$this->marque}";
  }
}

class Scooter extends Vehicule implements Roulant
{

  public function __construct(string $marque, public string $couleur)
  {
    return parent::__construct($marque);
  }

  public function demarrer()
  {
    return "Le scooter démarre.";
  }

  public function rouler(float $distance): string
  {
    return "Le scooter roule sur $distance km.";
  }
}

class Avion extends Vehicule implements Roulant, Volant
{

  public function __construct(string $marque, public float $envergureAiles)
  {
    return parent::__construct($marque);
  }

  public function demarrer()
  {
    return "L'avion démarre.";
  }

  #[Override]
  public function rouler(float $distance): string
  {
    return "L'avion roule sur $distance km.";
  }

  #[Override]
  public function atterir(): string
  {
    return "L'avion atterit sans se crasher";
  }

  #[Override]
  public function decoller(): string
  {
    return "L'avion décolle sans turbulence";
  }
}

// $v = new Vehicule(""); // Impossible d'instancier une classe qui est abstraite.

$scooter1 = new Scooter("Vespa", "rouge");
$avion1 = new Avion("Boeing", 25);

$vehicules = [
  $scooter1,
  $avion1,
  new Scooter("Vespa", "bleu"),
  new Avion("F35", 15)
];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <h1>Démonstration 08 - L'abstraction et interfaces</h1>

  <?php foreach ($vehicules as $v): ?>

    <p><?= $v->marque ?></p>
    <?php if ($v instanceof Scooter): ?>
      <p><?= $v->couleur ?></p>
    <?php endif ?>

    <?php if ($v instanceof Avion): ?>
      <p><?= $v->envergureAiles ?></p>
    <?php endif ?>

    <?php if ($v instanceof Roulant): ?>
      <p><?= $v->rouler(50) ?></p>
    <?php endif ?>

    <?php if ($v instanceof Volant): ?>
      <p><?= $v->decoller() ?></p>
      <p><?= $v->atterir() ?></p>
    <?php endif ?>




  <?php endforeach ?>

</body>

</html>