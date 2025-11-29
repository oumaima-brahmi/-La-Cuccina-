<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignecommande
 *
 * @ORM\Table(name="lignecommande", indexes={@ORM\Index(name="panier", columns={"idPanier"})})
 * @ORM\Entity
 */
class Lignecommande
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLigneCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlignecommande;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idProduit", type="integer", nullable=true)
     */
    private $idproduit;

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var int
     *
     * @ORM\Column(name="idPanier", type="integer", nullable=false)
     */
    private $idpanier;

    public function getIdlignecommande(): ?int
    {
        return $this->idlignecommande;
    }

    public function getIdproduit(): ?int
    {
        return $this->idproduit;
    }

    public function setIdproduit(?int $idproduit): static
    {
        $this->idproduit = $idproduit;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getIdpanier(): ?int
    {
        return $this->idpanier;
    }

    public function setIdpanier(int $idpanier): static
    {
        $this->idpanier = $idpanier;

        return $this;
    }


}
