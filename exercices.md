# Exercices : PHP Orienté Objet


## Exercice 01 - Analyser avant de coder

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


## Exercice 02 - La classe Ordinateur

1. Créez une classe `Ordinateur` contenant une seule propriété publique : `$marque` (une chaîne de caractères).
2. Ajoutez-lui une méthode `presenter()` qui retourne la phrase : "Cet ordinateur est un <marque>."
3. Dans le programme principal, créez deux objets :
- le premier de marque "Dell"
- le second de marque "Asus"
4. Affichez la présentation de chacun.

Résultat attendu à l'écran :
```txt
Cet ordinateur est un Dell.
Cet ordinateur est un Asus
```