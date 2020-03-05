<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipoColaRepository")
 */
class TipoCola
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cola", mappedBy="tipo")
     */
    private $colas;

    public function __construct()
    {
        $this->colas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection|Cola[]
     */
    public function getColas(): Collection
    {
        return $this->colas;
    }

    public function addCola(Cola $cola): self
    {
        if (!$this->colas->contains($cola)) {
            $this->colas[] = $cola;
            $cola->setTipo($this);
        }

        return $this;
    }

    public function removeCola(Cola $cola): self
    {
        if ($this->colas->contains($cola)) {
            $this->colas->removeElement($cola);
            // set the owning side to null (unless already changed)
            if ($cola->getTipo() === $this) {
                $cola->setTipo(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->descripcion;
    }
}
