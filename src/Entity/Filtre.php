<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FiltreRepository")
 */
class Filtre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Beat", mappedBy="genre")
     */
    private $beats;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genre;

    public function __construct()
    {
        $this->beats = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Beat[]
     */
    public function getBeats(): Collection
    {
        return $this->beats;
    }

    public function addBeat(Beat $beat): self
    {
        if (!$this->beats->contains($beat)) {
            $this->beats[] = $beat;
            $beat->setGenre($this);
        }

        return $this;
    }

    public function removeBeat(Beat $beat): self
    {
        if ($this->beats->contains($beat)) {
            $this->beats->removeElement($beat);
            // set the owning side to null (unless already changed)
            if ($beat->getGenre() === $this) {
                $beat->setGenre(null);
            }
        }

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function __toString()
    {
       return $this->getGenre();
    }


}
