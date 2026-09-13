<?php

require_once __DIR__ . '/models/produit-physique.php';
require_once __DIR__ . '/models/livre.php';
require_once __DIR__ . '/models/produit-numerique.php';
require_once __DIR__ . '/models/panier.php';

// $produit = new Produit("T-shirt PHP", 20.00, 2); // Fatal error : classe abstraite → OK

// 1. Créer un panier
$panier = new Panier();

// 2. Ajouter les produits (avec arguments nommés)
$panier->ajouter(new ProduitPhysique("T-shirt PHP", 20.00, poidsKg: 0.20, quantite: 2));
$panier->ajouter(new Livre("Clean Code", 39.99, poidsKg: 0.60, auteur: "Robert C. Martin", isbn: "978-0132350884"));
$panier->ajouter(new Livre("PHP Objets", 35.00, poidsKg: 0.50, auteur: "Pascal Martin", isbn: "978-2212674347"));
$panier->ajouter(new ProduitNumerique("E-book : Débuter en POO", 9.99, tailleMo: 4.2, lienTelechargement: "https://phpshop.test/dl/ebook-poo"));

// 3. Facture
$facture = $panier->afficherFacture();

// 4. Quantité invalide
$erreurQuantite = "";
try {
  $panier->getProduits()[0]->setQuantite(-3);
} catch (InvalidArgumentException $e) {
  $erreurQuantite = "Exception attrapée : " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHPShop</title>
</head>

<body>

  <h1>PHPShop - Projet récapitulatif</h1>

  <div><?= $facture ?></div>

  <p><?= htmlspecialchars($erreurQuantite) ?></p>

  <!-- 5. Parcours du panier -->
  <h2>Détail du panier</h2>
  <ul>
    <?php foreach ($panier->getProduits() as $produit): ?>
      <li>
        <?= htmlspecialchars($produit->getDescription()) ?> —
        <?php if ($produit instanceof Livrable): ?>
          livrable en <?= $produit->getDelaiJours() ?> jour(s)
        <?php else: ?>
          téléchargement immédiat
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>

  <p>Produits créés : <?= Produit::getNbProduitsCrees() ?></p>

</body>

</html>