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
9. [Vocabulaire à retenir](#9-vocabulaire-à-retenir)
10. [Feuille de route du cours](#10-feuille-de-route-du-cours)

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

## 9. Vocabulaire à retenir

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
| `instanceof` | Tester si un objet est d'un type (classe) donné |

---

## 10. Feuille de route du cours

- [x] Programmation fonctionnelle vs orientée objet
- [x] Les classes et les objets
- [x] Les propriétés et les méthodes
- [x] Le constructeur (`__construct`, promotion de propriétés, arguments nommés)
- [x] L'encapsulation (`private`, getters / setters, exceptions)
- [x] L'héritage et le polymorphisme (`extends`, `parent::`, `instanceof`)
- [ ] Les interfaces (remplacer l'héritage multiple)
- [ ] *(bonus)* Les classes abstraites, le mot-clé `static`

Exercice récapitulatif à venir : **Panier et produits**.

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
├── exercices.md                  → Énoncés de tous les exercices
└── README.md                     → Ce document
```
