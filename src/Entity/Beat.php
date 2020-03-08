<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

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
     * @Vich\UploadableField(mapping="beat_file", fileNameProperty="beatName")
     *
     * @var File|null
     */
    private $beatFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $beatName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
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

}
