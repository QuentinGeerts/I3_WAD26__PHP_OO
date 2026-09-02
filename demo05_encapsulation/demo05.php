<?php

// public: Accès de partout
// private: Accès uniquement dans la classe
// protected: (héritage) Accès uniquement dans la classe mère et ses filles

class Thermostat {
  // public float $temperatureCible = 19;
  private float $temperatureCible = 19;

  public function __construct(float $temperature)
  {
    $this->temperatureCible = $temperature;
  }

  public function getTemperatureCible(): float {
    return $this->temperatureCible;
  }

  public function setTemperatureCible(float $nouvelleTemperature): void {
    $min = 10.0;
    $max = 25.0;

    if ($nouvelleTemperature < $min || $nouvelleTemperature > $max) {
      throw new InvalidArgumentException("La température (" . $nouvelleTemperature . ") doit être comprise entre " . $min . " et " . $max);
    }
    $this->temperatureCible = $nouvelleTemperature;
  }

}

$t1 = new Thermostat(22);

try {
  $t1->setTemperatureCible(850);
} 
catch (\Throwable $th) {
  echo $th->getMessage() . PHP_EOL;
}

try {
  $t1->setTemperatureCible(10);
}
catch (InvalidArgumentException $e) {
  echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <h1>Démonstration 05 - L'encapsulation</h1>

  <p>Température cible: <?= $t1->getTemperatureCible() ?></p>

</body>

</html>