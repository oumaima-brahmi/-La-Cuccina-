<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Donation
 *
 * @ORM\Table(name="donation", indexes={@ORM\Index(name="idutilisateur", columns={"idUtilisateur"})})
 * @ORM\Entity
 */
class Donation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_donation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDonation;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_don", type="date", nullable=false)
     */
    private $dateDon;

    /**
     * @var string
     *
     * @ORM\Column(name="type_don", type="string", length=200, nullable=false)
     */
    private $typeDon;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idUtilisateur", type="integer", nullable=true)
     */
    private $idutilisateur;

    public function getIdDonation(): ?int
    {
        return $this->idDonation;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateDon(): ?\DateTimeInterface
    {
        return $this->dateDon;
    }

    public function setDateDon(\DateTimeInterface $dateDon): static
    {
        $this->dateDon = $dateDon;

        return $this;
    }

    public function getTypeDon(): ?string
    {
        return $this->typeDon;
    }

    public function setTypeDon(string $typeDon): static
    {
        $this->typeDon = $typeDon;

        return $this;
    }

    public function getIdutilisateur(): ?int
    {
        return $this->idutilisateur;
    }

    public function setIdutilisateur(?int $idutilisateur): static
    {
        $this->idutilisateur = $idutilisateur;

        return $this;
    }


}
