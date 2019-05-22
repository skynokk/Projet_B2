<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgenceRepository")
 */
class Agence
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
    private $nomAgence;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Agent", mappedBy="idAgence")
     */
    private $agents;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localisation", inversedBy="agences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $iDAdresse;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAgence(): ?string
    {
        return $this->nomAgence;
    }

    public function setNomAgence(string $nomAgence): self
    {
        $this->nomAgence = $nomAgence;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
            $agent->setIdAgence($this);
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        if ($this->agents->contains($agent)) {
            $this->agents->removeElement($agent);
            // set the owning side to null (unless already changed)
            if ($agent->getIdAgence() === $this) {
                $agent->setIdAgence(null);
            }
        }

        return $this;
    }

    public function getIDAdresse(): ?Localisation
    {
        return $this->iDAdresse;
    }

    public function setIDAdresse(?Localisation $iDAdresse): self
    {
        $this->iDAdresse = $iDAdresse;

        return $this;
    }
}
