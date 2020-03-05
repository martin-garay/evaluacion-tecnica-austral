<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 
/**
 * @ApiResource(
 *     normalizationContext={"groups"={"get"}},
 *     itemOperations={
 *         "get"
 *         
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TurnoRepository")
 */
class Turno
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get", "put"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_creacion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $atendido;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_atendido;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cola", inversedBy="turnos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cola;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fecha_creacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fecha_creacion): self
    {
        $this->fecha_creacion = $fecha_creacion;

        return $this;
    }

    public function getAtendido(): ?bool
    {
        return $this->atendido;
    }

    public function setAtendido(bool $atendido): self
    {
        $this->atendido = $atendido;

        return $this;
    }

    public function getFechaAtendido(): ?\DateTimeInterface
    {
        return $this->fecha_atendido;
    }

    public function setFechaAtendido(?\DateTimeInterface $fecha_atendido): self
    {
        $this->fecha_atendido = $fecha_atendido;

        return $this;
    }

    public function getCola(): ?Cola
    {
        return $this->cola;
    }

    public function setCola(?Cola $cola): self
    {
        $this->cola = $cola;

        return $this;
    }
}
