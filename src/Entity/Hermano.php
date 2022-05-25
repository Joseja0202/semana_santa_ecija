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

    #[ORM\Column(type: 'string',length: 255)]
    private $fecha_nacimiento;

    #[ORM\Column(type: 'string',length: 255)]
    private $telefono;

    #[ORM\Column(type: 'string')]
    private $direccion;

    #[ORM\Column(type: 'string')]
    private $dni;

    #[ORM\ManyToOne(targetEntity: Hermandad::class, inversedBy: 'hermanos')]
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

    public function getFecha_nacimiento(): ?string
    {
        return $this->fecha_nacimiento;
    }

    public function setFecha_nacimiento(string $fecha_nacimiento): self
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getHermandad(): ?Hermandad
    {
        return $this->hermandad;
    }

    public function setHermandad(?Hermandad $hermandad): self
    {
        $this->hermandad = $hermandad;

        return $this;
    }
}
