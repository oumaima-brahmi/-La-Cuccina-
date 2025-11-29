<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userevent
 *
 * @ORM\Table(name="userevent", indexes={@ORM\Index(name="id_utilisateur", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class Userevent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idEvent;

    /**
     * @var int
     *
     * @ORM\Column(name="id_utilisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUtilisateur;

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }


}
