<?php

require_once __DIR__ . '/produit.php';
require_once __DIR__ . '/../interfaces/livrable.php';

class ProduitPhysique extends Produit implements Livrable
{
  // Attributs

  // Constructeurs

  #[Override]
  public function __construct(string $nom, float $prixHT, $quantite = 1, private float $poidsKg = 0)
  {
    parent::__construct($nom, $prixHT, $quantite);

    if ($this->poidsKg < 0)
      throw new InvalidArgumentException("Le poids ne peut pas être négatif. ({$this->poidsKg})");
  }

  // Méthodes abstraites

  // Méthodes concrètes (implémentation des méthodes de l'interface)
  
  #[Override]
  public function getTauxTva(): float
  {
    return 0.21;
  }

  #[Override]
  public function getDescription(): string
  {
    return "Produit physique : {$this->getNom()} ({$this->poidsKg} kg)";
  }

  #[Override]
  public function getFraisLivraison(): float
  {
    return 1.5 * ($this->poidsKg * $this->getQuantite());
  }

  #[Override]
  public function getDelaiJours(): int
  {
    return 3;
  }

  // Getters

  public function getPoidsKg(): float
  {
    return $this->poidsKg;
  }
}
