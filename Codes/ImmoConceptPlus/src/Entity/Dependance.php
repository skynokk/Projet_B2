<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DependanceRepository")
 */
class Dependance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomDependance;

    /**
     * @ORM\Column(type="integer")
     */
    private $superficie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BienImmobilier", inversedBy="dependances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idBien;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDependance(): ?string
    {
        return $this->nomDependance;
    }

    public function setNomDependance(string $nomDependance): self
    {
        $this->nomDependance = $nomDependance;

        return $this;
    }

    public function getSuperficie(): ?int
    {
        return $this->superficie;
    }

    public function setSuperficie(int $superficie): self
    {
        $this->superficie = $superficie;

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
