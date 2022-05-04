<?php

namespace App\Entity;

use App\Repository\HermanoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HermanoRepository::class)]
class Hermano
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $apellido1;

    #[ORM\Column(type: 'string', length: 255)]
    private $apellido2;

    #[ORM\Column(type: 'date')]
    private $fecha_nacimiento;

    #[ORM\Column(type: 'integer')]
    private $telefono;

    #[ORM\ManyToOne(targetEntity: hermandad::class, inversedBy: 'hermanos')]
    #[ORM\JoinColumn(nullable: false)]
    private $hermandad;

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

    public function getApellido1(): ?string
    {
        return $this->apellido1;
    }

    public function setApellido1(string $apellido1): self
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    public function getApellido2(): ?string
    {
        return $this->apellido2;
    }

    public function setApellido2(string $apellido2): self
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fecha_nacimiento): self
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getHermandad(): ?hermandad
    {
        return $this->hermandad;
    }

    public function setHermandad(?hermandad $hermandad): self
    {
        $this->hermandad = $hermandad;

        return $this;
    }
}
