<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitIngredient
 *
 * @ORM\Table(name="produit_ingredient", indexes={@ORM\Index(name="produit_ingredient_ibfk_2", columns={"id_ingredient"}), @ORM\Index(name="produit_ingredient_ibfk_1", columns={"id_produit"})})
 * @ORM\Entity
 */
class ProduitIngredient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     */
    private $idProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="id_ingredient", type="integer", nullable=false)
     */
    private $idIngredient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function setIdProduit(int $idProduit): static
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    public function getIdIngredient(): ?int
    {
        return $this->idIngredient;
    }

    public function setIdIngredient(int $idIngredient): static
    {
        $this->idIngredient = $idIngredient;

        return $this;
    }


}
