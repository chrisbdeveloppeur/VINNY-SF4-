<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeatRepository")
 * @Vich\Uploadable
 */
class Beat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @Vich\UploadableField(mapping="beat_image", fileNameProperty="beatImageName")
     *
     * @var File|null
     * @Assert\Image(
     *     maxSize="8Mi",
     *     mimeTypes={"image/jpeg", "image/png"},
     *     mimeTypesMessage = "Seul les fichier jpg/jpeg/png sont acceptés")
     */
    private $beatImage;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private $beatImageName;



    /**
     *
     * @Vich\UploadableField(mapping="beat_file", fileNameProperty="beatName")
     *
     * @var File|null
     * @Assert\File(
     *     maxSize="20Mi",
     *     mimeTypes={"audio/mpeg","application/x-font-gdos"})
     */
    private $beatFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private $beatName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $artiste;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $album;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genre;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $bpm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $iframe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getArtiste(): ?string
    {
        return $this->artiste;
    }

    public function setArtiste(string $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getAlbum(): ?string
    {
        return $this->album;
    }

    public function setAlbum(?string $album): self
    {
        $this->album = $album;

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

    /**
     * @return File|null
     */
    public function getBeatFile(): ?File
    {
        return $this->beatFile;
    }

    /**
     * @param File|null $beatFile
     * @return Beat
     */
    public function setBeatFile(?File $beatFile): Beat
    {
        $this->beatFile = $beatFile;
        if ($this->beatFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBeatName(): ?string
    {
        return $this->beatName;
    }

    /**
     * @param string|null $beatName
     * @return Beat
     */
    public function setBeatName(?string $beatName): Beat
    {
        $this->beatName = $beatName;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getBeatImage(): ?File
    {
        return $this->beatImage;
    }

    /**
     * @param File|null $beatImage
     * @return Beat
     */
    public function setBeatImage(?File $beatImage): Beat
    {
        $this->beatImage = $beatImage;
        if ($this->beatImage instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBeatImageName(): ?string
    {
        return $this->beatImageName;
    }

    /**
     * @param string|null $beatImageName
     * @return Beat
     */
    public function setBeatImageName(?string $beatImageName): Beat
    {
        $this->beatImageName = $beatImageName;
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

    public function getBpm(): ?float
    {
        return $this->bpm;
    }

    public function setBpm(?float $bpm): self
    {
        $this->bpm = $bpm;

        return $this;
    }

    public function getIframe(): ?string
    {
        return $this->iframe;
    }

    public function setIframe(?string $iframe): self
    {
        $this->iframe = $iframe;

        return $this;
    }

}
