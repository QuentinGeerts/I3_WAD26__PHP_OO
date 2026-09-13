<?php

/**
 * Importation de l'interface Facturable.
 * 
 * L'utilisation de __DIR__ permet de construire un chemin absolu basé sur
 * l'emplacement de ce fichier (models/produit.php), garantissant que le
 * require fonctionne correctement quel que soit le point d'entrée du script.
 */
require_once __DIR__ . '/../interfaces/facturable.php';

abstract class Produit implements Facturable
{

  // Attributs
  private static int $nbProduitsCrees = 0;

  // Constructeurs

  public function __construct(private string $nom, private float $prixHT, private int $quantite = 1)
  {
    if ($this->nom === "")
      throw new InvalidArgumentException("Le nom ne peut pas être vide. ({$this->nom})");

    if ($this->prixHT < 0)
      throw new InvalidArgumentException("Le prix ne peut pas être négatif. ({$this->prixHT})");

    if ($this->quantite < 1)
      throw new InvalidArgumentException("La quantité ne peut pas être inférieure à 1. ({$this->quantite})");

    self::$nbProduitsCrees++;
  }

  // Méthodes abstraites

  public abstract function getTauxTva(): float;
  public abstract function getDescription(): string;

  // Méthodes concrètes (implémentation des méthodes de l'interface)

  public function getPrixTTC(): float
  {
    return $this->prixHT * (1 + $this->getTauxTva()) * $this->quantite;
  }

  public function getLigneFacture(): string
  {
    return "{$this->quantite} x {$this->nom} - {$this->getPrixTTC()} € TTC";
  }

  // Getters

  public function getNom(): string
  {
    return $this->nom;
  }

  public function getPrixHT(): float
  {
    return $this->prixHT;
  }

  public function getQuantite(): int
  {
    return $this->quantite;
  }

  public static function getNbProduitsCrees(): int
  {
    return self::$nbProduitsCrees;
  }

  public function setQuantite(int $quantite): void
  {
    if ($quantite < 1)
      throw new InvalidArgumentException("La quantité ne peut pas être inférieure à 1. ({$quantite})");

    $this->quantite = $quantite;
  }
}
