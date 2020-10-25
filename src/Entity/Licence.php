<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(
     *     max="50",
     *     maxMessage="Le titre est trop long (50 caractères max)"
     * )
     */
    private $titre;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Length(
     *     max="4",
     *     maxMessage="Le prix est trop élevé (4 chiffres max)"
     * )
     * @Assert\Type(
     *     type="float",
     *     message="Vous devez entrer un nombre"
     * )
     */
    private $euro;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Length(
     *     max="4",
     *     maxMessage="Le prix est trop élevé (4 chiffres max)"
     * )
     * @Assert\Type(
     *     type="float",
     *     message="Vous devez entrer un nombre"
     * )
     */
    private $dollar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_6;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="50",
     *     maxMessage="Le titre est trop long (50 caractères max)"
     * )
     */
    private $titre_fr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_1_fr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_2_fr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_3_fr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_4_fr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_5_fr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="100",
     *     maxMessage="l'information est trop longue (100 caractères max)"
     * )
     */
    private $info_6_fr;

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

    public function getInfo5(): ?string
    {
        return $this->info_5;
    }

    public function setInfo5(?string $info_5): self
    {
        $this->info_5 = $info_5;

        return $this;
    }

    public function getInfo6(): ?string
    {
        return $this->info_6;
    }

    public function setInfo6(?string $info_6): self
    {
        $this->info_6 = $info_6;

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

    public function getTitreFr(): ?string
    {
        return $this->titre_fr;
    }

    public function setTitreFr(?string $titre_fr): self
    {
        $this->titre_fr = $titre_fr;

        return $this;
    }

    public function getInfo1Fr(): ?string
    {
        return $this->info_1_fr;
    }

    public function setInfo1Fr(?string $info_1_fr): self
    {
        $this->info_1_fr = $info_1_fr;

        return $this;
    }

    public function getInfo2Fr(): ?string
    {
        return $this->info_2_fr;
    }

    public function setInfo2Fr(?string $info_2_fr): self
    {
        $this->info_2_fr = $info_2_fr;

        return $this;
    }

    public function getInfo3Fr(): ?string
    {
        return $this->info_3_fr;
    }

    public function setInfo3Fr(?string $info_3_fr): self
    {
        $this->info_3_fr = $info_3_fr;

        return $this;
    }

    public function getInfo4Fr(): ?string
    {
        return $this->info_4_fr;
    }

    public function setInfo4Fr(?string $info_4_fr): self
    {
        $this->info_4_fr = $info_4_fr;

        return $this;
    }

    public function getInfo5Fr(): ?string
    {
        return $this->info_5_fr;
    }

    public function setInfo5Fr(?string $info_5_fr): self
    {
        $this->info_5_fr = $info_5_fr;

        return $this;
    }

    public function getInfo6Fr(): ?string
    {
        return $this->info_6_fr;
    }

    public function setInfo6Fr(?string $info_6_fr): self
    {
        $this->info_6_fr = $info_6_fr;

        return $this;
    }
}
