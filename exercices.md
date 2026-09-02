# Exercices : PHP Orienté Objet


## Exercice 01 - Analyser avant de coder (Introduction)

Aucun code à écrire pour cet exercice, uniquement de la réflexion écrite.

Dans les phrases suivantes, indiquez ce qui correspond à une classe et ce qui correspond à un objet :
- « Une voiture possède une marque et une couleur. »
- « Ma Clio rouge est garée devant chez moi. »
- « Le compte bancaire de M. Dupont contient 250 €. »
- « Un compte bancaire permet de déposer et de retirer de l'argent. »

On souhaite modéliser un téléphone portable. Proposez :
3 propriétés (des données)
2 méthodes (des actions)

Question de vocabulaire : quelle est la différence entre une propriété et une méthode ?


## Exercice 02 - La classe Ordinateur (Classes)

1. Créez une classe `Ordinateur` contenant une seule propriété publique : `$marque` (une chaîne de caractères).
2. Ajoutez-lui une méthode `presenter()` qui retourne la phrase : "Cet ordinateur est un <marque>."
3. Dans le programme principal, créez deux objets :
- le premier de marque "Dell"
- le second de marque "Asus"
4. Affichez la présentation de chacun.

Résultat attendu à l'écran :
```txt
Cet ordinateur est un Dell.
Cet ordinateur est un Asus.
```

## Exercice 3.1 - La classe Rectangle (Attributs / Méthodes)

Créez une classe `Rectangle` avec deux propriétés : `$largeur` et `$hauteur` (des nombres décimaux).

Ajoutez les méthodes suivantes :
- `surface()` : retourne largeur × hauteur
- `perimetre()` : retourne (largeur + hauteur) × 2
- `estCarre()` : retourne true si largeur et hauteur sont égales
- ``decrire()`` : retourne une phrase utilisant les trois méthodes ci-dessus

Testez avec deux rectangles :
- un de 5 × 3
- un de 4 × 4

Résultat attendu :

```
Rectangle 5x3 : surface = 15, périmètre = 16. Ce n'est pas un carré.
Rectangle 4x4 : surface = 16, périmètre = 16. C'est un carré !
```

## Exercice 3.2 - Classe Produit avec prix TTC

Crée une classe `Produit` avec les propriétés nom et prix (HT, hors taxes).

Ajoute une méthode `prixTTC(float $tauxTva)` qui retourne le prix TTC (ex. prixTTC(0.20) pour une TVA à 20%).

Crée un tableau de plusieurs Produit, affiche pour chacun son prix HT et son prix TTC, puis calcule et affiche le total TTC du panier.

## Exercice 4 - La classe Livre (Constructeur)

### Partie 1 : La base

Créez une classe Livre avec quatre propriétés publiques :
- `$titre` (chaîne)
- `$auteur` (chaîne)
- `$nbPages` (entier)
- `$prix` (nombre décimal)

Créez deux objets :
- « Le Petit Prince », de Saint-Exupéry, 96 pages, 7.90 €
- « 1984 », de George Orwell, 328 pages, 9.50 €

Affichez pour chaque livre une ligne du type : 
```
'titre' de 'auteur' - 'nbPages' pages - 'prix' €
```

Soldes ! Appliquez une réduction de 50 % sur le prix du second livre, puis réaffichez sa ligne.

### Partie 2 : Constructeur

Ajoutez un constructeur qui reçoit `$titre`, `$auteur`, `$nbPages` et `$prix`. 
Le paramètre `$prix` aura la valeur par défaut 0.

Ajoutez une méthode ``decrire()`` qui retourne la ligne de description.

Ajoutez une méthode `estGros()` qui retourne true si le livre fait plus de 300 pages.

Ajoutez une méthode `appliquerReduction(float $pourcentage)` qui diminue le prix du pourcentage indiqué.

Créez les deux mêmes livres qu'à l'exercice 3, mais en une seule ligne chacun, puis appliquez 50 % de réduction sur « 1984 ».


## Exercice 5 - Le compte bancaire sécurisé (Encapsulation)

Créez une classe `CompteBancaire` complète :

1. Propriétés : `$titulaire` (publique) et `$solde` (privée, valeur de départ 0).
2. Constructeur recevant le nom du titulaire.
3. Méthode `getSolde()` qui retourne le solde.
4. Méthode `deposer(float $montant)` :
  - refuse un montant négatif ou nul,
  - sinon ajoute le montant au solde.
5. Méthode `retirer(float $montant)` :
  - refuse un montant négatif ou nul,
  - refuse si le solde est insuffisant,
  - sinon retire le montant.
6. Méthode `afficherReleve()` qui retourne : "Compte de <titulaire> - Solde : <solde> €"

**Scénario de test à réaliser** : déposer 500 €, retirer 200 €, essayer de retirer 1000 €, essayer de déposer -10 €, puis afficher le relevé.


## Exercice 6 — Véhicules (Héritage)

1. Créez une classe `Vehicule` avec :
  - les propriétés `$marque` et `$vitesseMax`
  - un constructeur les initialisant
  - une méthode `decrire()` retournant : "<marque> - vitesse max : <vitesseMax> km/h"
  - une méthode `demarrer()` retournant "Le véhicule démarre."
2. Créez une classe `Voiture` qui hérite de `Vehicule` et qui :
  - ajoute une propriété `$nbPortes`
  - possède un constructeur recevant marque, vitesse max et nombre de portes
  - redéfinit `demarrer()` pour retourner "Vroum ! La voiture démarre."
  - ajoute une méthode `klaxonner()` retournant "Tuuut !"
3. Créez une classe Velo qui hérite de `Vehicule` et redéfinit `demarrer()` pour retourner "Un coup de pédale et c'est parti !".

**Testez** : créez une voiture Renault (180 km/h, 5 portes) et un vélo Btwin (30 km/h). Pour chacun, appelez `decrire()` puis `demarrer()`.