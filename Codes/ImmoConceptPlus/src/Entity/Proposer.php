<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProposerRepository")
 */
class Proposer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montantOffre;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $contreProposition;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="propositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idClient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BienImmobilier", inversedBy="propositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idBien;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantOffre(): ?float
    {
        return $this->montantOffre;
    }

    public function setMontantOffre(float $montantOffre): self
    {
        $this->montantOffre = $montantOffre;

        return $this;
    }

    public function getContreProposition(): ?float
    {
        return $this->contreProposition;
    }

    public function setContreProposition(?float $contreProposition): self
    {
        $this->contreProposition = $contreProposition;

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
