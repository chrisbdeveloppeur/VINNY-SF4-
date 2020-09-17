<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiapoRepository")
 * @Vich\Uploadable
 */
class Diapo
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
     *     maxMessage="Le titre est trop long"
     * )
     */
    private $titre;

    /**
     *
     * @Vich\UploadableField(mapping="diapo", fileNameProperty="diapoImageName")
     *
     * @var File|null
     * @Assert\Image(
     *     maxSize="8Mi",
     *     mimeTypes={"image/jpeg", "image/png", "image/svg+xml"},
     *     mimeTypesMessage = "Seul les fichier jpg/jpeg/png/svg sont acceptés")
     */
    private $diapoImage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diapoImageName;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="text",nullable=true)
     * @Assert\Length(
     *     max="250",
     *     maxMessage="Le text est trop long"
     * )
     */
    private $text;


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

    /**
     * @return File|null
     */
    public function getDiapoImage(): ?File
    {
        return $this->diapoImage;
    }

    /**
     * @param File|null $diapoImage
     * @return Diapo
     */
    public function setDiapoImage(?File $diapoImage): Diapo
    {
        $this->diapoImage = $diapoImage;
        if ($this->diapoImage instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiapoImageName(): ?string
    {
        return $this->diapoImageName;
    }

    /**
     * @param string|null $diapoImageName
     * @return Diapo
     */
    public function setDiapoImageName(?string $diapoImageName): Diapo
    {
        $this->diapoImageName = $diapoImageName;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }



}
