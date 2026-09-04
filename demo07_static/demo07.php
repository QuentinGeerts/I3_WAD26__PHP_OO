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

  private static function enregistrer(string $operation, float $resultat): float 
  {
    $resultat = round($resultat, self::PRECISION);
    
    self::$nbOperations++;
    // array_push(self::$historique, "$operation = $resultat");
    self::$historique[] = "$operation = $resultat";

    return $resultat;
  }
}

$c = new Calculatrice(); // OK mais aucun intérêt
$resultat = $c->addition(5, 3);
echo "5 + 3 = " . $resultat . "<br>";

// Attention: -> est liée à une instance
// Pour une classe: NomClasse::methode()
$resultat = Calculatrice::addition(5, 3);
echo "5 + 3 = " . $resultat . "<br>";

