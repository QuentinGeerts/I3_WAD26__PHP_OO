<?php

require_once __DIR__ . '/produit.php';
require_once __DIR__ . '/../interfaces/livrable.php';

class Panier
{

  public const FRAIS_DE_BASE = 4.99;

  public function __construct(private array $produits = [])
  {
    if ($produits === null)
      throw new InvalidArgumentException("Le tableau ne peut pas être null.");
  }

  // Méthodes

  public function ajouter(Produit $produit): void
  {
    $this->produits[] = $produit;
  }

  public function retirer(string $nom): void
  {
    $longueurInitiale = count($this->produits);

    $this->produits = array_filter(
      $this->produits,
      fn(Produit $p) => $p->getNom() !== $nom
    );

    // Reindexation du tableau pour éviter les trous dans les clés numériques
    $this->produits = array_values($this->produits);

    if (count($this->produits) === $longueurInitiale) {
      throw new InvalidArgumentException("Le produit '$nom' n'est pas présent dans le panier.");
    }
  }

  public function getNombreArticles(): int
  {
    return count($this->produits);
  }

  public function getFraisLivraisonTotaux(): float
  {
    $fraisTotaux = 0.0;
    $auMoinsUnColis = false;

    foreach ($this->produits as $p) {
      if ($p instanceof Livrable) {
        $auMoinsUnColis = true;
        $fraisTotaux += $p->getFraisLivraison();
      }
    }

    return $auMoinsUnColis ? self::FRAIS_DE_BASE + $fraisTotaux : 0.0;
  }

  public function getTotalTTC(): float
  {
    $totalTTC = 0.0;

    foreach ($this->produits as $p) {
      $totalTTC += $p->getPrixTTC();
    }

    return $totalTTC + $this->getFraisLivraisonTotaux();
  }

  public function getDelaiMaximum(): int
  {
    $delaiMax = 0;

    foreach ($this->produits as $p) {
      if ($p instanceof Livrable && $p->getDelaiJours() > $delaiMax) {
        $delaiMax = $p->getDelaiJours();
      }
    }

    return $delaiMax;
  }


  public function viderLePanier(): void
  {
    $this->produits = [];
  }

  public function afficherFacture(): string
  {
    if (count($this->produits) === 0)
      throw new Exception("Impossible d'afficher la facture, le panier est vide.");

    $facture = "<h3>=== FACTURE PHPSHOP ===<h3>";

    foreach ($this->produits as $p) {
      $facture .= "<p>{$p->getLigneFacture()}</p>";
    }

    $facture .= "-----------------------";

    $facture .= "<p>Frais de livraison: {$this->getFraisLivraisonTotaux()}</p>";
    $facture .= "<p>TOTAL: {$this->getTotalTTC()} €</p>";
    $facture .= "<p>Livraison sous {$this->getDelaiMaximum()} jour(s)</p>";

    return $facture;
  }

  public function getProduits(): array
  {
    return $this->produits;
  }
}
