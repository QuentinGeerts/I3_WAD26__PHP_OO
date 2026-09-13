<?php

require_once __DIR__ . '/produit.php';

class ProduitNumerique extends Produit
{
  // Attributs

  // Constructeurs
  public function __construct(
    string $nom,
    float $prixHT,
    $quantite = 1,
    private float $tailleMo = 0,
    private string $lienTelechargement = ""
  ) {
    parent::__construct($nom, $prixHT, $quantite);

    if ($this->tailleMo < 0)
      throw new InvalidArgumentException("La taille en Mo ne peut pas être négative. ({$this->tailleMo})");

    if ($this->lienTelechargement === "")
      throw new InvalidArgumentException("Le lien de téléchargement ne peut pas être vide.");
  }

  // Redéfinition de méthodes

  public function getTauxTva(): float
  {
    return 0.21;
  }

  public function getDescription(): string
  {
    return "Produit numérique : {$this->getNom()} ({$this->tailleMo} Mo)";
  }

  // Getters

  public function getTailleMo(): float
  {
    return $this->tailleMo;
  }

  public function getLienTelechargement(): string
  {
    return $this->lienTelechargement;
  }
}
