<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommuniquerRepository")
 */
class Communiquer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="messagesEnvoyes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idClientEmetteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="messagesRecus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idClientReceveur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getIdClientEmetteur(): ?Client
    {
        return $this->idClientEmetteur;
    }

    public function setIdClientEmetteur(?Client $idClientEmetteur): self
    {
        $this->idClientEmetteur = $idClientEmetteur;

        return $this;
    }

    public function getIdClientReceveur(): ?Client
    {
        return $this->idClientReceveur;
    }

    public function setIdClientReceveur(?Client $idClientReceveur): self
    {
        $this->idClientReceveur = $idClientReceveur;

        return $this;
    }
}
