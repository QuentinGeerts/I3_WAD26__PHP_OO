# I3 WAD26 — PHP Orienté Objet : Synthèse théorique

Ce README reprend, sous forme de synthèse pédagogique, la théorie de la programmation orientée objet (POO) en PHP vue en cours jusqu'à présent. Chaque section renvoie vers les fichiers de démonstration correspondants du dépôt.

## Sommaire

1. [De la programmation fonctionnelle à la POO](#1-de-la-programmation-fonctionnelle-à-la-poo)
2. [Les classes et les objets](#2-les-classes-et-les-objets)
3. [Les propriétés (attributs)](#3-les-propriétés-attributs)
4. [Les méthodes](#4-les-méthodes)
5. [Le mot-clé `$this`](#5-le-mot-clé-this)
6. [Le constructeur](#6-le-constructeur)
7. [L'encapsulation](#7-lencapsulation)
8. [L'héritage et le polymorphisme](#8-lhéritage-et-le-polymorphisme)
9. [Le mot-clé `static`](#9-le-mot-clé-static)
10. [Les classes abstraites](#10-les-classes-abstraites)
11. [Les interfaces](#11-les-interfaces)
12. [Classe abstraite ou interface ?](#12-classe-abstraite-ou-interface-)
13. [Organiser son code en fichiers](#13-organiser-son-code-en-fichiers)
14. [Vocabulaire à retenir](#14-vocabulaire-à-retenir)
15. [Feuille de route du cours](#15-feuille-de-route-du-cours)

---

## 1. De la programmation fonctionnelle à la POO

### 1.1. L'approche fonctionnelle

Sans la POO, on décrit un élève avec une série de variables indépendantes, et on écrit des fonctions séparées pour les traiter.

```php
$eleve1_nom = "Doe";
$eleve1_prenom = "Jane";
$eleve1_notes = [12, 14, 8, 15];

$eleve2_nom = "Doe";
$eleve2_prenom = "John";
$eleve2_notes = [12, 14, 8, 15];

function moyenne(array $notes): float {
  return array_sum($notes) / count($notes);
}

$eleve1_moyenne = moyenne($eleve1_notes);
```

Limites de cette approche :

- les **données sont dispersées** : rien ne relie explicitement `$eleve1_nom` et `$eleve1_notes` ;
- **ajouter un élève** oblige à dupliquer tout le jeu de variables ;
- rien n'empêche les **incohérences** (oublier une variable, mélanger les notes d'un élève avec celles d'un autre) ;
- les **fonctions et les données vivent séparément**, alors qu'elles décrivent la même chose.

### 1.2. L'approche orientée objet

L'idée centrale de la POO : **regrouper dans une même entité les données (attributs) et les comportements (méthodes) qui vont ensemble.**

```php
class Eleve {
  // Attributs = caractéristiques (ce que l'objet EST)
  public string $nom;
  public string $prenom;
  public array $notes;

  // Méthodes = comportements (ce que l'objet FAIT)
  public function moyenne(): float {
    return array_sum($this->notes) / count($this->notes);
  }
}

$eleve1 = new Eleve();
$eleve1->nom = "Doe";
$eleve1->prenom = "John";
$eleve1->notes = [14, 12, 10, 13];

echo $eleve1->moyenne();
```

Ce que l'on y gagne :

- un élève forme un **tout cohérent** ;
- la méthode `moyenne()` travaille sur **ses propres** notes, via `$this->notes` ;
- créer un nouvel élève se résume à `new Eleve()` ;
- le code parle le langage du domaine métier.

| | Programmation fonctionnelle | Programmation orientée objet |
|---|---|---|
| Données | variables indépendantes | attributs regroupés dans l'objet |
| Traitements | fonctions globales séparées | méthodes attachées à l'objet |
| Ajouter un cas | dupliquer un jeu de variables | `new Classe()` |
| Cohérence | à la charge du développeur | garantie par la structure |

📄 Voir [demo01_introduction/demo01.php](demo01_introduction/demo01.php)

---

## 2. Les classes et les objets

### 2.1. La classe : un modèle

Une **classe** est un plan de construction. Elle décrit ce que *seront* les objets de ce type (leurs propriétés) et ce qu'ils *sauront faire* (leurs méthodes). Elle ne contient elle-même aucune donnée concrète.

- on la déclare avec le mot-clé `class` ;
- convention de nommage : `UpperCamelCase`, au **singulier** (`Chien`, `CompteBancaire`).

```php
class Chien {
  public string $nom;                // une propriété (caractéristique)

  public function aboyer(): string { // une méthode (action)
    return $this->nom . " fait wouf !";
  }
}
```

### 2.2. L'objet : une instance

Un **objet** est un exemplaire concret construit à partir d'une classe, avec ses propres valeurs. On le crée avec le mot-clé `new`, qui réserve un espace en mémoire pour cette nouvelle instance.

```php
$chien1 = new Chien();
$chien2 = new Chien(); // un autre objet, sur le MÊME modèle
$chien3 = new Chien();
```

> Analogie : la classe est le **plan d'architecte** (ou le moule) ; les objets sont les **maisons construites** (ou les gâteaux démoulés). Un seul plan, autant d'exemplaires que l'on veut, chacun avec ses propres caractéristiques.

Savoir distinguer les deux dans une phrase :

- « Une voiture possède une marque et une couleur. » → **classe** (on parle du type en général).
- « Ma Clio rouge est garée devant chez moi. » → **objet** (un exemplaire précis, valeurs fixées).
- « Un compte bancaire permet de déposer et de retirer de l'argent. » → **classe** (comportements généraux).
- « Le compte bancaire de M. Dupont contient 250 €. » → **objet** (un exemplaire précis).

### 2.3. Accéder aux membres d'un objet

Un **membre** est un élément qui appartient à la classe : une propriété, une méthode… On y accède avec l'**opérateur flèche** `->`.

```php
$chien1->nom = "Rouky";     // écrire une propriété
echo $chien1->nom;          // lire une propriété
echo $chien1->aboyer();     // appeler une méthode → "Rouky fait wouf !"
```

📄 Voir [demo02_classes/demo02.php](demo02_classes/demo02.php) et [demo02_classes/exercices/exercice02.php](demo02_classes/exercices/exercice02.php)

---

## 3. Les propriétés (attributs)

Aussi appelées **attributs** ou **caractéristiques** : ce sont les **données** rangées dans l'objet. Techniquement, ce sont des variables déclarées dans le corps de la classe. Elles décrivent ce que l'objet **est**.

### 3.1. Déclaration et typage

```php
class CompteurDeVues {
  public string $page;
  public int $compteur;
}
```

- `public` : la **visibilité** du membre (accessible depuis l'extérieur de la classe) — voir plus tard le chapitre sur l'encapsulation ;
- `string`, `int`, `array`, … : le **type** de la propriété, que PHP fait respecter ;
- le nom de la propriété garde le `$` (`$compteur`), contrairement au nom de la classe.

### 3.2. Valeur par défaut

On peut **initialiser** une propriété directement à la déclaration. Tout objet créé partira alors de cette valeur.

```php
class CompteurDeVues {
  public string $page;
  public int $compteur = 0; // déclaration + initialisation
}
```

⚠️ Une propriété typée mais jamais initialisée est dans l'état « non définie » : y accéder avant de lui avoir donné une valeur provoque une erreur.

📄 Voir [demo03_attributs_methodes/demo03.php](demo03_attributs_methodes/demo03.php)

---

## 4. Les méthodes

Les **méthodes** sont les **comportements** de l'objet : des fonctions déclarées dans la classe, qui ont accès aux propriétés de cet objet. Elles décrivent ce que l'objet **fait**.

### 4.1. Procédure vs fonction

| | Rôle | Type de retour |
|---|---|---|
| **Procédure** | effectue une action, ne renvoie rien | `void` |
| **Fonction** | calcule et renvoie une valeur | `int`, `string`, `bool`, … |

```php
// Procédure : modifie l'état de l'objet, ne retourne rien
public function ajouterUneVue(): void {
  $this->compteur++;
}

// Fonction : retourne une valeur
public function est_populaire(): bool {
  return $this->compteur >= 100;
}
```

> Une comparaison (`$this->compteur >= 100`) est **déjà** un booléen : on la retourne directement, sans écrire `if (...) return true; else return false;`.

### 4.2. Paramètres et valeur par défaut

Comme une fonction classique, une méthode peut recevoir des paramètres, éventuellement avec une valeur par défaut.

```php
public function ajouterPlusieursVues(int $number = 10): void {
  if ($number <= 0) return;   // Fail Fast (voir 4.3)
  $this->compteur += $number;
}

$page->ajouterPlusieursVues();     // +10 (valeur par défaut)
$page->ajouterPlusieursVues(151);  // +151
```

### 4.3. Fail Fast Pattern

Plutôt que d'imbriquer tout le traitement dans un `if`, on **sort au plus tôt** (`return`) si les conditions ne sont pas réunies. Le code principal reste « à plat », donc plus lisible.

```php
// Au lieu de :
if ($number > 0) {
  $this->compteur += $number;
}

// On écrit :
if ($number <= 0) return;
$this->compteur += $number;
```

### 4.4. Une méthode peut en appeler une autre

Depuis une méthode, on accède aux autres membres du même objet avec `$this->`.

```php
public function resumer(): string {
  $etat = $this->est_populaire() ? "populaire" : "non populaire";
  return "[$etat] La page " . $this->page . " a " . $this->compteur . " vue(s)";
}
```

> `condition ? valeurSiVrai : valeurSiFaux` est l'**opérateur ternaire**, un raccourci de `if/else` qui renvoie une valeur.

📄 Voir [demo03_attributs_methodes/demo03.php](demo03_attributs_methodes/demo03.php) et les exercices 3.1 / 3.2 de [exercices.md](exercices.md)

---

## 5. Le mot-clé `$this`

Dans le corps d'une méthode, `$this` désigne **l'objet sur lequel la méthode a été appelée**. C'est lui qui permet à une méthode de lire ou modifier les propriétés de *son* objet, et pas celles d'un autre.

```php
$chien1->aboyer(); // à l'intérieur de aboyer(), $this correspond à $chien1
$chien2->aboyer(); // à l'intérieur de aboyer(), $this correspond à $chien2
```

- `$this->nom` → la propriété `nom` de l'objet courant ;
- `$this->aboyer()` → appelle la méthode `aboyer()` de l'objet courant ;
- `$this` n'existe **que** dans les méthodes d'instance ; il n'a aucun sens en dehors d'une classe.

---

## 6. Le constructeur

Le **constructeur** est une méthode spéciale, exécutée **automatiquement au moment du `new`**. Son rôle : mettre l'objet dans un état valide dès sa création, sans avoir à affecter chaque propriété à la main ligne par ligne.

### 6.1. Constructeur par défaut vs constructeur personnalisé

- Toute classe possède un **constructeur par défaut**, implicite, qui ne prend aucun paramètre et ne fait rien de particulier (`new Chien()` fonctionne même sans l'avoir écrit).
- Dès que l'on déclare notre propre `__construct()`, il **remplace** le constructeur par défaut : `new` exige alors les arguments qu'on a définis.

```php
class Chaussette {
  public int $pointure_min;
  public int $pointure_max;
  public string $couleur;
  public string $matiere;
  public bool $est_propre = true;

  public function __construct(
    int $pointure_min, int $pointure_max, string $couleur,
    string $matiere, bool $est_propre = true
  ) {
    $this->pointure_min = $pointure_min;
    $this->pointure_max = $pointure_max;
    $this->couleur      = $couleur;
    $this->matiere      = $matiere;
    $this->est_propre   = $est_propre;
  }
}

$c1 = new Chaussette(41, 47, "bleu", "coton", true);
$c2 = new Chaussette(35, 40, "violet", "synthétique", false);
$c3 = new Chaussette(25, 30, "rouge", "coton"); // est_propre prend sa valeur par défaut
```

- le nom est **toujours** `__construct` (deux underscores) ;
- il ne renvoie rien (pas de type de retour) ;
- les **paramètres avec valeur par défaut** se placent en dernier, comme pour n'importe quelle fonction.

### 6.2. Promotion des propriétés dans le constructeur (PHP 8)

Le schéma « un paramètre → une propriété → une affectation `$this->x = $x` » est tellement fréquent que PHP 8 permet de l'écrire en une fois : on préfixe le paramètre par sa **visibilité** (`public`, `private`, `protected`). PHP déclare alors la propriété **et** fait l'affectation automatiquement.

```php
class Tshirt {
  public function __construct(
    public string $taille = "S",
    public string $couleur = "noir"
  ) { }
}
```

Cette classe est strictement équivalente à une version où l'on déclarerait `public string $taille;` / `public string $couleur;` puis `$this->taille = $taille;` dans le corps du constructeur.

### 6.3. Arguments nommés

À l'appel, on peut passer les arguments **par leur nom** (`nom: valeur`) au lieu de respecter l'ordre. Pratique pour sauter des paramètres qui ont une valeur par défaut.

```php
$t1 = new Tshirt("XL", "noir");
$t3 = new Tshirt();                 // tout par défaut
$t4 = new Tshirt("L");              // couleur par défaut
$t5 = new Tshirt(couleur: "rose"); // on saute $taille, on ne nomme que $couleur
```

📄 Voir [demo04_constructeur/demo04.php](demo04_constructeur/demo04.php) et l'exercice 4 : [demo04_constructeur/exercices/exo04.php](demo04_constructeur/exercices/exo04.php)

---

## 7. L'encapsulation

**Encapsuler**, c'est **protéger les données de l'objet** : on interdit l'accès direct depuis l'extérieur et on oblige à passer par des méthodes qui contrôlent ce qui rentre. L'objet reste ainsi toujours dans un état cohérent.

### 7.1. Les visibilités

| Mot-clé | Accessible depuis… |
|---|---|
| `public` | partout (extérieur compris) |
| `private` | uniquement l'intérieur de la classe |
| `protected` | la classe **et** ses classes filles (voir héritage) |

### 7.2. Getters et setters

Une propriété `private` ne se lit ni ne s'écrit avec `->` depuis l'extérieur. On expose alors :

- un **getter** (`getX()`) pour lire la valeur ;
- un **setter** (`setX()`) pour la modifier — c'est **là** que l'on valide.

```php
class Thermostat {
  private float $temperatureCible = 19;

  public function __construct(float $temperature) {
    $this->temperatureCible = $temperature;
  }

  public function getTemperatureCible(): float {
    return $this->temperatureCible;
  }

  public function setTemperatureCible(float $nouvelleTemperature): void {
    $min = 10.0;
    $max = 25.0;

    if ($nouvelleTemperature < $min || $nouvelleTemperature > $max) {
      throw new InvalidArgumentException(
        "La température ($nouvelleTemperature) doit être comprise entre $min et $max"
      );
    }
    $this->temperatureCible = $nouvelleTemperature;
  }
}
```

Sans setter, `$t->temperatureCible = 850;` passerait sans broncher. Avec, la valeur aberrante est refusée.

### 7.3. Signaler une erreur : les exceptions

Quand une méthode reçoit une donnée invalide, elle ne « corrige » pas en silence : elle **lève une exception** avec `throw`. L'exécution s'interrompt et remonte jusqu'à un bloc qui sait la gérer.

```php
$t1 = new Thermostat(22);

try {
  $t1->setTemperatureCible(850);       // lève InvalidArgumentException
} catch (InvalidArgumentException $e) {
  echo $e->getMessage();               // on récupère le message
}
```

- `throw new InvalidArgumentException("...")` : lève l'exception ;
- `try { ... } catch (TypeException $e) { ... }` : tente le code, et attrape l'exception si elle survient ;
- `$e->getMessage()` : le texte passé au constructeur de l'exception ;
- `InvalidArgumentException` est une classe fournie par PHP (SPL) pour « mauvais argument » ;
- `\Throwable` est le type le plus général : `catch (\Throwable $th)` attrape **tout** (exceptions et erreurs).

📄 Voir [demo05_encapsulation/demo05.php](demo05_encapsulation/demo05.php) et l'exercice 5 (compte bancaire sécurisé) dans [exercices.md](exercices.md)

---

## 8. L'héritage et le polymorphisme

### 8.1. L'héritage : `extends`

L'**héritage** permet à une classe (la **fille**) de récupérer les propriétés et méthodes d'une autre (la **mère**), puis d'ajouter ou de modifier ce qui lui est propre. On évite ainsi de réécrire du code commun.

```php
class Animal {
  public function __construct(public string $nom) { }

  public function crier(): string {
    return "{$this->nom} fait un cri générique";
  }
}

class Poule extends Animal {
  // hérite de $nom et du constructeur
  public function crier(): string {          // ← redéfinition
    return "{$this->nom} fait Cot-Cot !";
  }
}
```

### 8.2. Redéfinir une méthode (override) et `parent::`

Une classe fille peut **redéfinir** une méthode héritée en la réécrivant avec la même signature. Pour réutiliser la version de la mère à l'intérieur, on l'appelle avec `parent::`.

```php
class Poisson extends Animal {
  public function __construct(string $nom, public string $couleur) {
    parent::__construct($nom); // le parent initialise $nom, on gère $couleur
  }

  public function crier(): string {
    return parent::crier() . " mais de poisson";
  }
}
```

- si la fille définit son propre constructeur, elle doit **appeler explicitement** `parent::__construct(...)` si elle veut celui du parent ;
- `parent::maMethode()` appelle la version de la classe mère.

### 8.3. Héritage sur plusieurs niveaux

Une fille peut elle-même servir de mère : `PoissonChirurgien extends Poisson extends Animal`. La chaîne des `parent::` se propage de niveau en niveau.

### 8.4. Pas d'héritage multiple

Une classe ne peut hériter que d'**une seule** classe. `class Omnivore extends Carnivore, Herbivore` est **interdit** en PHP. La solution (chapitre suivant) sera les **interfaces**.

### 8.5. Le polymorphisme

**Polymorphisme** = « plusieurs formes ». Comme une `Poule` **est un** `Animal`, partout où un `Animal` est attendu on peut passer une `Poule`, un `Poisson`, etc. Le code manipule le type général ; à l'exécution, c'est la méthode **réellement définie sur l'objet** qui s'exécute.

```php
class Zoo {
  public function __construct(private array $animaux = []) { }

  public function ajouter_animal(Animal $animal): void { // accepte toute sous-classe d'Animal
    $this->animaux[] = $animal;
  }
}

$zoo = new Zoo();
$zoo->ajouter_animal(new Poule("Tilly"));
$zoo->ajouter_animal(new Poisson("Wanda", "bleu"));
$zoo->ajouter_animal(new PoissonChirurgien("Dori", "bleu"));
```

### 8.6. `instanceof`

PHP n'a pas de « cast de classe ». Pour savoir si un objet est d'un type donné (afin d'accéder à un membre spécifique de la sous-classe), on teste avec `instanceof`.

```php
$a1 = $zoo->getAnimal(2);

if ($a1 instanceof Poisson) {
  $couleur = $a1->couleur; // sûr : on sait que c'est un Poisson
} else {
  $couleur = "inconnue";
}
```

> Le type-hint `Animal $animal` dans une signature vérifie automatiquement que l'argument est un `Animal` (ou une de ses sous-classes) : PHP lève une `TypeError` sinon.

📄 Voir [demo06_heritage_polymorphisme/demo06.php](demo06_heritage_polymorphisme/demo06.php) et l'exercice 6 (Véhicules) dans [exercices.md](exercices.md)

---

## 9. Le mot-clé `static`

Jusqu'ici, chaque membre appartenait à **un objet** : deux `Article` ont chacun leur `$nom` et leur `$prixHT`. Le mot-clé `static` change ce rattachement : le membre appartient à la **classe elle-même**, pas à ses instances.

| | Membre **non** `static` | Membre `static` |
|---|---|---|
| Attaché à… | une instance (créée avec `new`) | la classe (le modèle) |
| Combien d'exemplaires ? | un par objet | **un seul**, partagé par tous |
| Accès | `$objet->membre` | `Classe::membre` |
| `$this` disponible ? | oui | non (il n'y a aucun objet) |

### 9.1. L'opérateur de résolution de portée `::`

`->` s'adresse à une instance, `::` s'adresse à une classe.

```php
$article->prixTTC();      // méthode d'instance : il faut un objet
Article::getNombre();     // méthode de classe : aucun objet nécessaire
```

- `self::` → la classe courante, **depuis l'intérieur** de celle-ci ;
- `parent::` → la classe mère (déjà vu en 8.2) ;
- `NomClasse::` → une classe précise, depuis l'extérieur.

### 9.2. Les constantes de classe

Une **constante de classe** est une valeur figée, commune à toute la classe : un taux de TVA, une précision d'arrondi, des frais fixes…

```php
class Article {
  public const TVA = 0.21;   // pas de $, pas de type, valeur non modifiable

  public function prixTTC(): float {
    return $this->prixHT * (1 + self::TVA);
  }
}

echo Article::TVA; // 0.21 — depuis l'extérieur
```

- convention de nommage : `UPPER_SNAKE_CASE` ;
- le nom ne prend **pas** de `$` ;
- une constante est implicitement statique : elle s'utilise avec `::`, jamais avec `->`.

### 9.3. Les propriétés statiques

Une propriété `static` vit dans la classe : toutes les instances lisent et écrivent **la même** case mémoire. C'est l'outil idéal pour un compteur ou un historique partagé.

```php
class Article {
  private static int $nombre = 0;

  public function __construct(public string $nom, public float $prixHT) {
    self::$nombre++;   // note le $ : self::$nombre
  }

  public static function getNombre(): int {
    return self::$nombre;
  }
}

new Article("Sandwich", 4.5);
new Article("Ordinateur portable", 699);

echo Article::getNombre(); // 2
```

⚠️ Attention à la syntaxe : `self::$nombre` pour une **propriété** statique (avec `$`), `self::TVA` pour une **constante** (sans `$`).

### 9.4. Les méthodes statiques

Une méthode `static` s'appelle directement sur la classe. Elle sert aux **fonctions utilitaires**, qui ne dépendent d'aucun objet particulier.

```php
class Calculatrice {
  public const PRECISION = 2;
  public static int $nbOperations = 0;

  public static function addition(float $a, float $b): float {
    return self::enregistrer("$a + $b", $a + $b);
  }

  private static function enregistrer(string $operation, float $resultat): float {
    self::$nbOperations++;
    return round($resultat, self::PRECISION);
  }
}

Calculatrice::addition(5, 3); // aucun new nécessaire
```

- une méthode statique **n'a pas** de `$this` : elle ne peut donc pas lire les propriétés d'instance ;
- elle accède aux autres membres statiques avec `self::` ;
- PHP tolère `$objet->addition(5, 3)`, mais c'est trompeur : l'appel reste attaché à la classe, pas à l'objet.

### 9.5. `self` ou `static` ?

Les deux désignent « la classe », mais pas la même :

- `self` → la classe dans laquelle le code est **écrit** ;
- `static` → la classe avec laquelle le code est **exécuté** (on parle de *late static binding*, liaison statique tardive).

La différence n'apparaît qu'en cas d'héritage :

```php
class Calculatrice {
  public const PRECISION = 2;

  public static function precisionAvecSelf(): int   { return self::PRECISION; }
  public static function precisionAvecStatic(): int { return static::PRECISION; }
}

class CalculatriceScientifique extends Calculatrice {
  public const PRECISION = 6; // redéfinition de la constante
}

echo CalculatriceScientifique::precisionAvecSelf();   // 2 → celle de Calculatrice
echo CalculatriceScientifique::precisionAvecStatic(); // 6 → celle de la classe appelée
```

📄 Voir [demo07_static/demo07.php](demo07_static/demo07.php) et l'exercice 7 : [demo07_static/exercices/exo07.php](demo07_static/exercices/exo07.php)

---

## 10. Les classes abstraites

### 10.1. Le problème : une classe mère trop générale

En 8.1, `Animal` était une classe normale : rien n'empêchait d'écrire `new Animal("truc")` et d'obtenir un animal qui « fait un cri générique ». Or « un véhicule » ou « un produit » tout court n'existe pas : seuls un `Scooter`, un `Avion`, un `Livre` existent vraiment. La classe mère n'est là que pour **factoriser** ce qui est commun.

### 10.2. Déclarer une classe abstraite : `abstract class`

Le mot-clé `abstract` interdit l'instanciation de la classe : elle ne peut plus servir que de base à d'autres classes.

```php
abstract class Vehicule {
  public function __construct(public string $marque) { }
}

$v = new Vehicule("Vespa"); // Fatal error : Cannot instantiate abstract class Vehicule
$s = new Scooter("Vespa", "rouge"); // OK : la fille, elle, est concrète
```

### 10.3. Déclarer une méthode abstraite

Une méthode **abstraite** annonce une signature **sans corps** : la mère impose le comportement sans savoir comment il sera réalisé.

```php
abstract class Vehicule {
  public abstract function demarrer(); // pas d'accolades, juste un point-virgule
}
```

- une méthode abstraite ne peut exister que dans une classe abstraite ;
- elle ne peut pas être `private` : la fille ne pourrait pas la voir pour l'implémenter.

### 10.4. Implémenter les méthodes abstraites dans les filles

Chaque classe fille concrète **doit** fournir un corps à toutes les méthodes abstraites héritées, avec la même signature.

```php
class Scooter extends Vehicule {
  public function demarrer() {
    return "Le scooter démarre.";
  }
}

class Avion extends Vehicule {
  public function demarrer() {
    return "L'avion démarre.";
  }
}
```

Si une fille en oublie une, PHP refuse de charger la classe — à moins qu'elle ne soit elle-même déclarée `abstract` et laisse le travail à la génération suivante.

### 10.5. Mélanger méthodes abstraites et méthodes concrètes

C'est tout l'intérêt de la classe abstraite : elle apporte des propriétés, un constructeur et du **code déjà écrit** à toute la famille, et ne laisse abstrait que ce qui varie d'une fille à l'autre.

```php
abstract class Vehicule {
  public function __construct(public string $marque) { }

  public abstract function demarrer();       // varie → à écrire dans chaque fille

  public function decrire(): string {        // commun → écrit une seule fois
    return "Marque: {$this->marque}";
  }
}
```

Une fille garde le droit de redéfinir une méthode concrète (override, voir 8.2) ; elle n'a simplement pas l'**obligation** de le faire.

### 10.6. Le constructeur d'une classe abstraite

Une classe abstraite peut avoir un constructeur : il ne sera jamais appelé par `new Vehicule(...)`, mais par les filles via `parent::__construct()`.

```php
class Scooter extends Vehicule {
  public function __construct(string $marque, public string $couleur) {
    parent::__construct($marque); // la mère initialise $marque
  }

  public function demarrer() {
    return "Le scooter démarre.";
  }
}
```

### 10.7. Polymorphisme et classe abstraite

Le type abstrait reste utilisable comme **type commun** : on range les filles dans un même tableau, on les type-hint avec la mère, et chacune répond à sa façon.

```php
$vehicules = [
  new Scooter("Vespa", "rouge"),
  new Avion("Boeing", 25),
  new Scooter("Vespa", "bleu"),
];

foreach ($vehicules as $v) {
  echo $v->decrire();   // code de la mère
  echo $v->demarrer();  // code de la fille réellement instanciée
}
```

> Une méthode concrète de la mère peut même appeler une méthode abstraite : `getPrixTTC()` utilise `$this->getTauxTva()` alors que ce taux n'existe nulle part dans la mère. À l'exécution, `$this` est forcément une fille concrète, qui l'a donc implémentée.

📄 Voir [demo08_abstract_interface/demo08.php](demo08_abstract_interface/demo08.php) et l'exercice 8 (bulletins de paie) dans [exercices.md](exercices.md)

---

## 11. Les interfaces

### 11.1. Le problème : partager une capacité sans parenté

Un `Avion` roule **et** vole, un `Scooter` roule seulement. Ces capacités ne suivent pas l'arbre d'héritage, et une classe ne peut hériter que d'une seule mère (voir 8.4). Il faut donc un autre outil : le **contrat**.

### 11.2. Déclarer une interface

Une **interface** est une liste de méthodes qu'une classe s'engage à fournir. Elle ne contient **aucun code** ni aucune propriété : uniquement des signatures.

```php
interface Volant {
  function decoller(): string;
  function atterir(): string;
}

interface Roulant {
  function rouler(float $distance): string;
}
```

- toutes les méthodes d'une interface sont implicitement `public` ;
- une interface ne s'instancie pas ;
- on la nomme souvent d'après une capacité : `Volant`, `Roulant`, `Facturable`, `Livrable`, `Exportable`.

### 11.3. Signer le contrat : `implements`

```php
class Scooter extends Vehicule implements Roulant {
  public function demarrer() {
    return "Le scooter démarre.";
  }

  public function rouler(float $distance): string { // obligatoire
    return "Le scooter roule sur $distance km.";
  }
}
```

Si une méthode du contrat manque, PHP refuse de charger la classe : *Fatal error: Class Scooter contains 1 abstract method…*. L'interface ne dit **pas** comment faire : chaque classe fournit sa propre implémentation.

### 11.4. Implémenter plusieurs interfaces

C'est **la** réponse à l'absence d'héritage multiple : une classe n'hérite que d'**une** classe, mais implémente **autant d'interfaces** qu'elle veut, séparées par des virgules.

```php
class Avion extends Vehicule implements Roulant, Volant {
  public function demarrer()                      { return "L'avion démarre."; }
  public function rouler(float $distance): string { return "L'avion roule sur $distance km."; }
  public function decoller(): string              { return "L'avion décolle sans turbulence"; }
  public function atterir(): string               { return "L'avion atterit sans se crasher"; }
}
```

### 11.5. Combiner héritage et interfaces

`extends` vient toujours **avant** `implements`. Les deux mécanismes se cumulent sans se gêner : on hérite du code commun, on signe les capacités.

```php
abstract class Produit implements Facturable { /* ... */ }
class ProduitPhysique extends Produit implements Livrable { /* ... */ }
class Livre extends ProduitPhysique { /* ... */ }          // hérite des deux contrats
class ProduitNumerique extends Produit { /* ... */ }        // facturable, mais pas livrable
```

### 11.6. `instanceof` et type-hint sur une interface

`instanceof` fonctionne avec une interface exactement comme avec une classe. On ne demande plus « de quel type es-tu ? » mais « **sais-tu faire** ceci ? ».

```php
$vehicules = [new Scooter("Vespa", "rouge"), new Avion("Boeing", 25)];

foreach ($vehicules as $v) {
  echo $v->demarrer();

  if ($v instanceof Roulant) echo $v->rouler(50);
  if ($v instanceof Volant)  echo $v->decoller();
}
```

Le même tableau contient des objets de familles différentes, et chacun n'est sollicité que sur ce qu'il sait réellement faire.

Une interface s'utilise aussi comme **type** dans une signature :

```php
public function facturer(Facturable $element): string {
  return $element->getLigneFacture(); // peu importe la classe concrète
}
```

C'est du polymorphisme (8.5) fondé sur la **capacité** plutôt que sur la parenté : deux classes sans aucun lien peuvent être traitées par le même code.

📄 Voir [demo08_abstract_interface/demo08.php](demo08_abstract_interface/demo08.php) et l'exercice 9 (export CSV) dans [exercices.md](exercices.md)

---

## 12. Classe abstraite ou interface ?

Les deux imposent des méthodes aux classes filles ; le choix dépend de ce que l'on veut **partager**.

| | Classe abstraite | Interface |
|---|---|---|
| Mot-clé de liaison | `extends` | `implements` |
| Combien à la fois ? | **une seule** | autant que nécessaire |
| Propriétés | oui | non |
| Constructeur | oui | non |
| Code déjà écrit | oui (méthodes concrètes) | non (signatures uniquement) |
| Visibilités | toutes | `public` uniquement |
| Relation exprimée | « **est un** » (parenté) | « **sait faire** » (capacité) |

- On choisit une **classe abstraite** quand les filles appartiennent à la même famille et partagent un état et du code : `ProduitPhysique` et `ProduitNumerique` sont deux `Produit`.
- On choisit une **interface** quand des classes sans lien de parenté doivent offrir la même capacité : un `Client` et une `Facture` n'ont rien en commun, mais tous deux sont `Exportable`.
- Les deux se combinent très bien : `abstract class Produit implements Facturable`, puis `class ProduitPhysique extends Produit implements Livrable`.

---

## 13. Organiser son code en fichiers

Dès qu'un projet dépasse quelques classes, on applique la règle **un fichier par classe / par interface**, rangés par rôle (`models/`, `interfaces/`), avec un seul point d'entrée (`index.php`).

```php
// models/produit.php
require_once __DIR__ . '/../interfaces/facturable.php';

abstract class Produit implements Facturable { /* ... */ }
```

```php
// index.php
require_once __DIR__ . '/models/produit-physique.php';
require_once __DIR__ . '/models/livre.php';
require_once __DIR__ . '/models/panier.php';

$panier = new Panier();
```

- `require_once` inclut le fichier **une seule fois** : indispensable, car redéclarer une classe est une erreur fatale ;
- `__DIR__` est le dossier du fichier **courant** : le chemin reste correct quel que soit le script appelé ;
- chaque fichier inclut lui-même ce dont il dépend (un modèle inclut son interface, une fille inclut sa mère).

📄 Voir le projet récapitulatif [php-shop/index.php](php-shop/index.php) et son énoncé [mini-projet.md](mini-projet.md)

---

## 14. Vocabulaire à retenir

| Terme | Définition |
|---|---|
| Classe | Modèle / plan décrivant un type d'objet |
| Objet (instance) | Exemplaire concret créé à partir d'une classe |
| `new` | Opérateur qui crée une instance en mémoire |
| Membre | Élément appartenant à une classe (propriété ou méthode) |
| Propriété / attribut | Donnée rangée dans l'objet (ce qu'il *est*) |
| Méthode | Action de l'objet (ce qu'il *fait*) |
| `->` | Opérateur d'accès à un membre d'un objet |
| `$this` | Référence à l'objet courant, à l'intérieur d'une méthode |
| `void` | Type de retour d'une méthode qui ne renvoie rien |
| `__construct` | Méthode appelée automatiquement à la création de l'objet (`new`) |
| Promotion de propriété | Déclarer + affecter une propriété directement dans les paramètres du constructeur (PHP 8) |
| Argument nommé | Passer un argument par son nom (`couleur: "rose"`) plutôt que par sa position |
| Encapsulation | Protéger les données de l'objet en contrôlant les accès |
| `private` / `protected` | Visibilités restreintes : classe seule / classe + filles |
| Getter / setter | Méthodes d'accès en lecture / écriture à une propriété privée (le setter valide) |
| `throw` / `try` / `catch` | Lever une exception / tenter un code / attraper l'exception |
| Exception | Objet signalant une erreur, qui interrompt le flux normal |
| `extends` | Mot-clé d'héritage : une classe fille dérive d'une classe mère |
| Redéfinition (override) | Réécrire dans la fille une méthode héritée de la mère |
| `parent::` | Appeler la version parente d'une méthode / du constructeur |
| Polymorphisme | Traiter des objets de sous-types différents via leur type commun |
| `instanceof` | Tester si un objet est d'un type (classe ou interface) donné |
| `static` (membre) | Membre attaché à la classe et non à une instance, partagé par tous les objets |
| `::` | Opérateur de résolution de portée : accès à un membre de classe (`Classe::`, `self::`, `parent::`) |
| Constante de classe | Valeur figée déclarée avec `const`, accessible via `::`, sans `$` |
| `self` / `static` (mot-clé) | La classe où le code est *écrit* / la classe avec laquelle il est *exécuté* (late static binding) |
| Classe abstraite | Classe non instanciable, destinée à être héritée (`abstract class`) |
| Méthode abstraite | Signature sans corps, que chaque classe fille concrète doit implémenter |
| Interface | Contrat listant des méthodes publiques, sans code ni propriété |
| `implements` | Mot-clé par lequel une classe signe une ou plusieurs interfaces |
| `require_once` / `__DIR__` | Inclure un fichier une seule fois / dossier du fichier courant |

---

## 15. Feuille de route du cours

- [x] Programmation fonctionnelle vs orientée objet
- [x] Les classes et les objets
- [x] Les propriétés et les méthodes
- [x] Le constructeur (`__construct`, promotion de propriétés, arguments nommés)
- [x] L'encapsulation (`private`, getters / setters, exceptions)
- [x] L'héritage et le polymorphisme (`extends`, `parent::`, `instanceof`)
- [x] Le mot-clé `static` (constantes de classe, membres statiques, `self` / `static`)
- [x] Les classes abstraites (`abstract`, méthodes abstraites)
- [x] Les interfaces (`implements`, remplacer l'héritage multiple)
- [x] Exercice récapitulatif : **PHPShop — panier et produits** ([mini-projet.md](mini-projet.md))

---

## Structure du dépôt

```
.
├── demo01_introduction/          → Programmation fonctionnelle vs orientée objet
│   └── exercices/                → Exercice 01 (analyse classe / objet)
├── demo02_classes/               → Déclarer une classe, instancier avec new, opérateur ->
│   └── exercices/                → Exercice 02 (classe Ordinateur)
├── demo03_attributs_methodes/    → Propriétés, méthodes, void, fail fast, $this
├── demo04_constructeur/          → __construct, promotion de propriétés, arguments nommés
│   └── exercices/                → Exercice 04 (classe Livre)
├── demo05_encapsulation/         → public/private/protected, getters/setters, exceptions
├── demo06_heritage_polymorphisme/ → extends, override, parent::, instanceof, polymorphisme
├── demo07_static/                → const, propriétés/méthodes statiques, ::, self vs static
│   └── exercices/                → Exercice 07 (compteur d'articles et TVA)
├── demo08_abstract_interface/    → abstract class, méthodes abstraites, interfaces, implements
├── php-shop/                     → Correction de l'exercice récapitulatif
│   ├── interfaces/               → Facturable, Livrable
│   ├── models/                   → Produit, ProduitPhysique, Livre, ProduitNumerique, Panier
│   └── index.php                 → Scénario de test
├── exercices.md                  → Énoncés de tous les exercices
├── mini-projet.md                → Énoncé de l'exercice récapitulatif (PHPShop)
└── README.md                     → Ce document
```
