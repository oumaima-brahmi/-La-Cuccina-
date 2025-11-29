<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Evenements
 *
 * @ORM\Table(name="evenements", indexes={@ORM\Index(name="idUtilisateur", columns={"idUtilisateur"})})
 * @ORM\Entity
 */
class Evenements
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_event", type="string", length=255, nullable=true)
     */
    private $nomEvent;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_event", type="date", nullable=true)
     */
    private $dateEvent;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_event", type="time", nullable=true)
     */
    private $heureEvent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description_event", type="string", length=255, nullable=true)
     */
    private $descriptionEvent;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idUtilisateur", type="integer", nullable=true)
     */
    private $idutilisateur;

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    public function getNomEvent(): ?string
    {
        return $this->nomEvent;
    }

    public function setNomEvent(?string $nomEvent): static
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateEvent;
    }

    public function setDateEvent(?\DateTimeInterface $dateEvent): static
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    public function getHeureEvent(): ?\DateTimeInterface
    {
        return $this->heureEvent;
    }

    public function setHeureEvent(?\DateTimeInterface $heureEvent): static
    {
        $this->heureEvent = $heureEvent;

        return $this;
    }

    public function getDescriptionEvent(): ?string
    {
        return $this->descriptionEvent;
    }

    public function setDescriptionEvent(?string $descriptionEvent): static
    {
        $this->descriptionEvent = $descriptionEvent;

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
