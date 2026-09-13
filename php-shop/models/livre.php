<?php

require_once __DIR__ . '/produit-physique.php';

class Livre extends ProduitPhysique
{

  // Attributs

  // Constructeurs

  public function __construct(
    string $nom,
    float $prixHT,
    $quantite = 1,
    float $poidsKg = 0,
    private string $auteur = "",
    private string $isbn = ""
  ) {
    parent::__construct($nom, $prixHT, $quantite, $poidsKg);

    if ($this->auteur === "")
      throw new InvalidArgumentException("L'auteur ne peut pas être vide.");

    if ($this->isbn === "")
      throw new InvalidArgumentException("L'isbn ne peut pas être vide.");
  }

  // Redéfinition de méthodes

  public function getTauxTva(): float
  {
    return 0.06;
  }

  public function getDescription(): string
  {
    return parent::getDescription() . " - auteur: {$this->auteur}";
  }

  public function getDelaiJours(): int
  {
    return 2;
  }

  // Getters

  public function getAuteur(): string
  {
    return $this->auteur;
  }

  public function getIsbn(): string
  {
    return $this->isbn;
  }
}
