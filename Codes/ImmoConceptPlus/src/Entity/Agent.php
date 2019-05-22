<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AgentRepository")
 * @UniqueEntity("idPersonne")
 */
class Agent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $adresseMail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Agence", inversedBy="agents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAgence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPersonne;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Client", inversedBy="agents")
     */
    private $clients;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $photo;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    public function getIdAgence(): ?Agence
    {
        return $this->idAgence;
    }

    public function setIdAgence(?Agence $idAgence): self
    {
        $this->idAgence = $idAgence;

        return $this;
    }

    public function getIdPersonne(): ?Personne
    {
        return $this->idPersonne;
    }

    public function setIdPersonne(?Personne $idPersonne): self
    {
        $this->idPersonne = $idPersonne;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->contains($client)) {
            $this->clients->removeElement($client);
        }

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
