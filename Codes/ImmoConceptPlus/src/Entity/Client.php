<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @UniqueEntity("adresseMail")
 * @UniqueEntity("idPersonne")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     * @Assert\Email
     */
    private $adresseMail;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Agent", mappedBy="clients")
     */
    private $agents;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="filleuls")
     */
    private $idParrain;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Client", mappedBy="idParrain")
     */
    private $filleuls;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localisation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAdresse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPersonne;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Communiquer", mappedBy="idClientEmetteur")
     */
    private $messagesEnvoyes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Communiquer", mappedBy="idClientReceveur")
     */
    private $messagesRecus;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\BienImmobilier", inversedBy="clientsQuiAiment")
     */
    private $favoriser;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Proposer", mappedBy="idClient")
     */
    private $propositions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commenter", mappedBy="idClient")
     */
    private $commentaires;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $photo;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->filleuls = new ArrayCollection();
        $this->messagesEnvoyes = new ArrayCollection();
        $this->messagesRecus = new ArrayCollection();
        $this->favoriser = new ArrayCollection();
        $this->propositions = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
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
            $agent->addClient($this);
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        if ($this->agents->contains($agent)) {
            $this->agents->removeElement($agent);
            $agent->removeClient($this);
        }

        return $this;
    }

    public function getIdParrain(): ?self
    {
        return $this->idParrain;
    }

    public function setIdParrain(?self $idParrain): self
    {
        $this->idParrain = $idParrain;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getFilleuls(): Collection
    {
        return $this->filleuls;
    }

    public function addFilleul(self $filleul): self
    {
        if (!$this->filleuls->contains($filleul)) {
            $this->filleuls[] = $filleul;
            $filleul->setIdParrain($this);
        }

        return $this;
    }

    public function removeFilleul(self $filleul): self
    {
        if ($this->filleuls->contains($filleul)) {
            $this->filleuls->removeElement($filleul);
            // set the owning side to null (unless already changed)
            if ($filleul->getIdParrain() === $this) {
                $filleul->setIdParrain(null);
            }
        }

        return $this;
    }

    public function getIdAdresse(): ?Localisation
    {
        return $this->idAdresse;
    }

    public function setIdAdresse(?Localisation $idAdresse): self
    {
        $this->idAdresse = $idAdresse;

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
     * @return Collection|Communiquer[]
     */
    public function getMessagesEnvoyes(): Collection
    {
        return $this->messagesEnvoyes;
    }

    public function addMessagesEnvoye(Communiquer $messagesEnvoye): self
    {
        if (!$this->messagesEnvoyes->contains($messagesEnvoye)) {
            $this->messagesEnvoyes[] = $messagesEnvoye;
            $messagesEnvoye->setIdClientEmetteur($this);
        }

        return $this;
    }

    public function removeMessagesEnvoye(Communiquer $messagesEnvoye): self
    {
        if ($this->messagesEnvoyes->contains($messagesEnvoye)) {
            $this->messagesEnvoyes->removeElement($messagesEnvoye);
            // set the owning side to null (unless already changed)
            if ($messagesEnvoye->getIdClientEmetteur() === $this) {
                $messagesEnvoye->setIdClientEmetteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Communiquer[]
     */
    public function getMessagesRecus(): Collection
    {
        return $this->messagesRecus;
    }

    public function addMessagesRecus(Communiquer $messagesRecus): self
    {
        if (!$this->messagesRecus->contains($messagesRecus)) {
            $this->messagesRecus[] = $messagesRecus;
            $messagesRecus->setIdClientReceveur($this);
        }

        return $this;
    }

    public function removeMessagesRecus(Communiquer $messagesRecus): self
    {
        if ($this->messagesRecus->contains($messagesRecus)) {
            $this->messagesRecus->removeElement($messagesRecus);
            // set the owning side to null (unless already changed)
            if ($messagesRecus->getIdClientReceveur() === $this) {
                $messagesRecus->setIdClientReceveur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BienImmobilier[]
     */
    public function getFavoriser(): Collection
    {
        return $this->favoriser;
    }

    public function addFavoriser(BienImmobilier $favoriser): self
    {
        if (!$this->favoriser->contains($favoriser)) {
            $this->favoriser[] = $favoriser;
        }

        return $this;
    }

    public function removeFavoriser(BienImmobilier $favoriser): self
    {
        if ($this->favoriser->contains($favoriser)) {
            $this->favoriser->removeElement($favoriser);
        }

        return $this;
    }

    /**
     * @return Collection|Proposer[]
     */
    public function getPropositions(): Collection
    {
        return $this->propositions;
    }

    public function addProposition(Proposer $proposition): self
    {
        if (!$this->propositions->contains($proposition)) {
            $this->propositions[] = $proposition;
            $proposition->setIdClient($this);
        }

        return $this;
    }

    public function removeProposition(Proposer $proposition): self
    {
        if ($this->propositions->contains($proposition)) {
            $this->propositions->removeElement($proposition);
            // set the owning side to null (unless already changed)
            if ($proposition->getIdClient() === $this) {
                $proposition->setIdClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commenter[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commenter $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setIdClient($this);
        }

        return $this;
    }

    public function removeCommentaire(Commenter $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdClient() === $this) {
                $commentaire->setIdClient(null);
            }
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
