<?php

namespace App\Entity;

use App\Repository\HermandadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HermandadRepository::class)]
class Hermandad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\OneToMany(mappedBy: 'hermandad', targetEntity: Hermano::class)]
    private $hermanos;

    public function __construct()
    {
        $this->hermanos = new ArrayCollection();
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

    /**
     * @return Collection<int, Hermano>
     */
    public function getHermanos(): Collection
    {
        return $this->hermanos;
    }

    public function addHermano(Hermano $hermano): self
    {
        if (!$this->hermanos->contains($hermano)) {
            $this->hermanos[] = $hermano;
            $hermano->setHermandad($this);
        }

        return $this;
    }

    public function removeHermano(Hermano $hermano): self
    {
        if ($this->hermanos->removeElement($hermano)) {
            // set the owning side to null (unless already changed)
            if ($hermano->getHermandad() === $this) {
                $hermano->setHermandad(null);
            }
        }

        return $this;
    }
}
