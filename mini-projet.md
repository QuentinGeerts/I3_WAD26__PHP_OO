# Exercice récapitulatif — PHPShop : panier et produits

**Notions** : classes, propriétés, méthodes, `$this`, constructeur, encapsulation, exceptions, héritage, polymorphisme, **classes abstraites**, **interfaces**.

## Contexte

Une boutique en ligne vend trois familles de produits : des produits physiques (poids, livraison), des livres (produits physiques à TVA réduite) et des produits numériques (téléchargement, pas de livraison). Tous se facturent, tous ne se livrent pas.

## Arborescence

```
phpshop/
├── classes/
└── index.php
```

Un fichier par classe / interface. Inclusions via `require_once` dans `index.php`.

---

## 1. Interface `Facturable`

- `getPrixTTC(): float`
- `getLigneFacture(): string`

## 2. Interface `Livrable`

- `getFraisLivraison(): float`
- `getDelaiJours(): int`

## 3. Classe abstraite `Produit` (implémente `Facturable`)

**Propriétés** (privées, promotion de propriétés dans le constructeur)

- `string $nom`
- `float $prixHT`
- `int $quantite` (défaut : `1`)

**Constructeur** — lève une `InvalidArgumentException` si : nom vide, prix HT négatif, quantité `< 1`.

**Méthodes abstraites**

- `getTauxTva(): float`
- `getDescription(): string`

**Méthodes concrètes**

- `getPrixTTC()` : `prixHT × (1 + tva) × quantite`
- `getLigneFacture()` : ex. `2 × T-shirt PHP — 48,40 € TTC`
- getters : `getNom()`, `getPrixHT()`, `getQuantite()`
- `setQuantite(int): void` avec validation

**Vérification** : `new Produit(...)` doit échouer.

## 4. `ProduitPhysique` (hérite de `Produit`, implémente `Livrable`)

- Propriété : `float $poidsKg`
- Constructeur : appel à `parent::__construct()`
- TVA : 21 %
- `getDescription()` : ex. `Produit physique : T-shirt PHP (0.20 kg)`
- `getFraisLivraison()` : `1.50 × poids total`
- `getDelaiJours()` : `3`

## 5. `Livre` (hérite de `ProduitPhysique`)

- Propriétés : `string $auteur`, `string $isbn`
- TVA : 6 % (redéfinition)
- `getDescription()` : réutilise `parent::getDescription()` + auteur
- `getDelaiJours()` : `2`

## 6. `ProduitNumerique` (hérite de `Produit`)

- Propriétés : `float $tailleMo`, `string $lienTelechargement`
- TVA : 21 %
- `getDescription()` : ex. `Produit numérique : E-book (4.2 Mo)`
- N'implémente **pas** `Livrable`

## 7. `Panier`

- Propriété : `array $produits` (privée)
- `ajouter(Produit $produit): void`
- `retirer(string $nom): void`
- `getNombreArticles(): int`
- `getFraisLivraisonTotaux(): float` — uniquement les produits `instanceof Livrable`, plus une constante `FRAIS_DE_BASE = 4.99` ajoutée **une seule fois** s'il y a au moins un colis
- `getTotalTTC(): float` — produits + frais de livraison
- `getDelaiMaximum(): int` — `0` si rien à livrer
- `viderLePanier(): void`
- `afficherFacture(): string` — exception si le panier est vide

## 8. Scénario de test (`index.php`)

1. Créer un panier.
2. Ajouter : 2 × T-shirt PHP (20,00 € HT, 0,20 kg), Clean Code (39,99 € HT, 0,60 kg, Robert C. Martin), PHP Objets (35,00 € HT, 0,50 kg, Pascal Martin), E-book (9,99 € HT, 4,2 Mo). Utiliser au moins une fois les **arguments nommés**.
3. Afficher la facture.
4. Tenter `setQuantite(-3)` dans un `try/catch`.
5. Parcourir le panier : afficher la description de chaque produit, puis « livrable en X jour(s) » ou « téléchargement immédiat ».

**Résultat attendu**

```
=== FACTURE PHPSHOP ===
2 × T-shirt PHP — 48,40 € TTC
1 × Clean Code — 42,39 € TTC
1 × PHP Objets — 37,10 € TTC
1 × E-book : Débuter en POO — 12,09 € TTC
-----------------------
Frais de livraison : 7,24 €
TOTAL : 147,22 €
Livraison sous 3 jour(s)
```

---

## Bonus

1. `private static int $nbProduitsCrees` + `getNbProduitsCrees(): int`
2. Constantes de classe pour les taux de TVA
3. `__toString()` sur `Produit`
4. Interface `Reductible` (`appliquerReduction(float $pourcentage): void`), implémentée par `ProduitNumerique` seul
5. `trierParPrixDecroissant(): void` sur le panier

---

## Checklist

- [ ] `new Produit(...)` impossible
- [ ] Aucune propriété `public`
- [ ] Toutes les méthodes abstraites implémentées dans les filles
- [ ] `ProduitNumerique` absent des frais de livraison
- [ ] `Livre` applique 6 % et utilise `parent::`
- [ ] Les valeurs invalides lèvent une exception
- [ ] `ajouter()` accepte les 3 types sans aucun test de type

---

## Documentation

- Classes abstraites : <https://www.php.net/manual/fr/language.oop5.abstract.php>
- Interfaces : <https://www.php.net/manual/fr/language.oop5.interfaces.php>
- Héritage : <https://www.php.net/manual/fr/language.oop5.inheritance.php>
- Visibilité : <https://www.php.net/manual/fr/language.oop5.visibility.php>
- Exceptions SPL : <https://www.php.net/manual/fr/spl.exceptions.php>