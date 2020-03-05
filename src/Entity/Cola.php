<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ColaRepository")
 */
class Cola
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
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoCola", inversedBy="colas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Turno", mappedBy="cola")
     */
    private $turnos;

    public function __construct()
    {
        $this->turnos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTipo(): ?TipoCola
    {
        return $this->tipo;
    }

    public function setTipo(?TipoCola $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection|Turno[]
     */
    public function getTurnos(): Collection
    {
        return $this->turnos;
    }

    public function addTurno(Turno $turno): self
    {
        if (!$this->turnos->contains($turno)) {
            $this->turnos[] = $turno;
            $turno->setCola($this);
        }

        return $this;
    }

    public function removeTurno(Turno $turno): self
    {
        if ($this->turnos->contains($turno)) {
            $this->turnos->removeElement($turno);
            // set the owning side to null (unless already changed)
            if ($turno->getCola() === $this) {
                $turno->setCola(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->nombre;
    }
}
