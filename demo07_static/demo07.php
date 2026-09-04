<?php

/*
  Démonstration 07 - Le mot-clef static
*/

// Règles :
// - Un membre NON static => attaché à une instance (objet) [new]
// - Un membre static => attaché à la classe (modèle)

// $this : la référence de l'objet sur lequel vous êtes
// self : la classe sur laquelle le code est écrit


class Calculatrice
{

  // Constante de classe
  public const PRECISION = 2;

  // Propriétés statiques: elles vivent dans la classe ; pas dans l'instance
  public static int $nbOperations = 0;
  private static array $historique = [];

  // Méthodes statiques: appelable directement sur la classe
  public static function addition(float $a, float $b): float
  {
    return self::enregistrer("$a + $b", $a + $b);
  }

  public static function soustraction(float $a, float $b): float
  {
    return self::enregistrer("$a - $b", $a - $b);
  }

  public static function multiplication(float $a, float $b): float
  {
    return self::enregistrer("$a * $b", $a * $b);
  }

  public static function division(float $a, float $b): float
  {
    if ($b == 0) {
      return self::enregistrer("$a / $b", 0.0);
    }

    return self::enregistrer("$a / $b", $a / $b);
  }

  private static function enregistrer(string $operation, float $resultat): float
  {
    $resultat = round($resultat, self::PRECISION);

    self::$nbOperations++;
    // array_push(self::$historique, "$operation = $resultat");
    self::$historique[] = "$operation = $resultat";

    return $resultat;
  }

  public static function getHistorique(): array
  {
    return self::$historique;
  }

  // self: la classe où le code est déclaré
  public static function precisionAvecSelf(): int
  {
    return self::PRECISION;
  }

  // static: la classe où le code est exécuté
  public static function precisionAvecStatic(): int
  {
    return static::PRECISION;
  }
}

class CalculatriceScientifique extends Calculatrice
{
  public const PRECISION = 6;
}

$c = new Calculatrice(); // OK mais aucun intérêt
$resultat = $c->addition(5, 3);
echo "5 + 3 = " . $resultat . "<br>";

// Attention: -> est liée à une instance
// Pour une classe: NomClasse::methode()
Calculatrice::addition(5, 3);
Calculatrice::soustraction(5, 3);
Calculatrice::multiplication(5, 3);
Calculatrice::division(5, 3);
Calculatrice::division(5, 0);

foreach (Calculatrice::getHistorique() as $operation) {
  echo $operation . "<br>";
}

CalculatriceScientifique::division(10, 3);

echo "Precision de Calculatrice: " . Calculatrice::PRECISION . "<br>"; // 2
echo "Precision de CalculatriceScientifique: " . CalculatriceScientifique::PRECISION . "<br>"; // 6

echo "Precision de CalculatriceScientifique: " . CalculatriceScientifique::precisionAvecSelf() . "<br>"; // 2
echo "Precision de CalculatriceScientifique: " . CalculatriceScientifique::precisionAvecStatic() . "<br>"; // 6
