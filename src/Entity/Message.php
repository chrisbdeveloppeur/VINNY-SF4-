<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[<>{}\/]/",
     *     match=false,
     *     message="Your last name cannot contain special characters",
     *)
     * @Assert\Length(
     *     max="150",
     *     maxMessage="150 Chars max allowed for your last name"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[<>{}\/]/",
     *     match=false,
     *     message="Your first name cannot contain special characters",
     *)
     *  @Assert\Length(
     *     max="150",
     *     maxMessage="150 Chars max allowed for your first name"
     * )
     */
    private $prenom;


    /**
     * @ORM\Column(type="text")
     * @Assert\Regex(
     *     pattern="/[<>{}\/]/",
     *     match=false,
     *     message="Your email cannot contain special characters",
     *     )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/[<>{}\/]/",
     *     match=false,
     *     message="The subject cannot contain special characters",
     * )
     * @Assert\Length(
     *     max="50",
     *     maxMessage="50 Chars max allowed for the subject"
     * )
     */
    private $objet;

    /**
     * @ORM\Column(type="text", length=500)
     * @Assert\Regex(
     *     pattern="/[<>{}\/]/",
     *     match=false,
     *     message="The message cannot contain special characters",
     * )
     * @Assert\Length(
     *     max="1000",
     *     maxMessage="1000 Chars max allowed for the message"
     * )
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     * @var string A "Y-m-d H:i:s" formatted value
     */
    private $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * Appelée lorsque l'objet est utilisé comme une chaine
     */
    public function __toString()
    {
        return $this->getMessage();
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Message
     */
    public function setDate(string $date): Message
    {
        $this->date = $date;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(?string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }



}
