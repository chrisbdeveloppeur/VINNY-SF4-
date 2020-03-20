<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LicenceRepository")
 */
class Licence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $euro;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $dollar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $info_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $info_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $info_3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $info_4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getEuro(): ?float
    {
        return $this->euro;
    }

    public function setEuro(?float $euro): self
    {
        $this->euro = $euro;

        return $this;
    }

    public function getDollar(): ?float
    {
        return $this->dollar;
    }

    public function setDollar(?float $dollar): self
    {
        $this->dollar = $dollar;

        return $this;
    }

    public function getInfo1(): ?string
    {
        return $this->info_1;
    }

    public function setInfo1(?string $info_1): self
    {
        $this->info_1 = $info_1;

        return $this;
    }

    public function getInfo2(): ?string
    {
        return $this->info_2;
    }

    public function setInfo2(?string $info_2): self
    {
        $this->info_2 = $info_2;

        return $this;
    }

    public function getInfo3(): ?string
    {
        return $this->info_3;
    }

    public function setInfo3(?string $info_3): self
    {
        $this->info_3 = $info_3;

        return $this;
    }

    public function getInfo4(): ?string
    {
        return $this->info_4;
    }

    public function setInfo4(?string $info_4): self
    {
        $this->info_4 = $info_4;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
