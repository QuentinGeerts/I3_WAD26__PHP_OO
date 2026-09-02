# I3 WAD26 — PHP Orienté Objet : Synthèse théorique

Ce README reprend, sous forme de synthèse pédagogique, la théorie de la programmation orientée objet (POO) en PHP vue en cours jusqu'à présent. Chaque section renvoie vers les fichiers de démonstration correspondants du dépôt.

## Sommaire

1. [De la programmation fonctionnelle à la POO](#1-de-la-programmation-fonctionnelle-à-la-poo)
2. [Les classes et les objets](#2-les-classes-et-les-objets)
3. [Les propriétés (attributs)](#3-les-propriétés-attributs)
4. [Les méthodes](#4-les-méthodes)
5. [Le mot-clé `$this`](#5-le-mot-clé-this)
6. [Vocabulaire à retenir](#6-vocabulaire-à-retenir)
7. [Feuille de route du cours](#7-feuille-de-route-du-cours)

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

## 6. Vocabulaire à retenir

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

---

## 7. Feuille de route du cours

- [x] Programmation fonctionnelle vs orientée objet
- [x] Les classes et les objets
- [x] Les propriétés et les méthodes
- [ ] Le constructeur
- [ ] L'encapsulation (`private`, getters / setters)
- [ ] L'héritage
- [ ] *(bonus)* Les classes abstraites, le mot-clé `static`, les interfaces

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
├── exercices.md                  → Énoncés de tous les exercices
└── README.md                     → Ce document
```
