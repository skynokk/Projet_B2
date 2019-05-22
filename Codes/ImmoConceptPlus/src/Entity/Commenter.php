<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommenterRepository")
 */
class Commenter
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
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idClient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BienImmobilier", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idBien;

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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getIdBien(): ?BienImmobilier
    {
        return $this->idBien;
    }

    public function setIdBien(?BienImmobilier $idBien): self
    {
        $this->idBien = $idBien;

        return $this;
    }
}
