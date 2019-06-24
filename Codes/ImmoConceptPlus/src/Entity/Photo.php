<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 * @UniqueEntity("chemin")
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nomPhoto;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $chemin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BienImmobilier", inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idBien;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPhoto(): ?string
    {
        return $this->nomPhoto;
    }

    public function setNomPhoto(?string $nomPhoto): self
    {
        $this->nomPhoto = $nomPhoto;

        return $this;
    }

    public function getChemin(): ?string
    {
        return $this->chemin;
    }

    public function setChemin(string $chemin): self
    {
        $this->chemin = $chemin;

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
