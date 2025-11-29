<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livraisons
 *
 * @ORM\Table(name="livraisons", indexes={@ORM\Index(name="commande", columns={"idCommande"})})
 * @ORM\Entity
 */
class Livraisons
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_livraison", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLivraison;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat_livraison", type="string", length=50, nullable=true)
     */
    private $etatLivraison;

    /**
     * @var int
     *
     * @ORM\Column(name="idCommande", type="integer", nullable=false)
     */
    private $idcommande;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    public function getIdLivraison(): ?int
    {
        return $this->idLivraison;
    }

    public function getEtatLivraison(): ?string
    {
        return $this->etatLivraison;
    }

    public function setEtatLivraison(?string $etatLivraison): static
    {
        $this->etatLivraison = $etatLivraison;

        return $this;
    }

    public function getIdcommande(): ?int
    {
        return $this->idcommande;
    }

    public function setIdcommande(int $idcommande): static
    {
        $this->idcommande = $idcommande;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }


}
