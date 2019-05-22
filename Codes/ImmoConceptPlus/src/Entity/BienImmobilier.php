<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BienImmobilierRepository")
 */
class BienImmobilier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $superficie;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPieces = 1;

    /**
     * @ORM\Column(type="integer")
     */
    private $etage = 0;

    /**
     * @ORM\Column(type="float")
     */
    private $prixMiseEnVente;

    /**
     * @ORM\Column(type="float")
     */
    private $prixMin;

    /**
     * @ORM\Column(type="date")
     */
    private $dateMiseEnVente;

    /**
     * @ORM\Column(type="integer")
     */
    private $visites = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vendue = false;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateVente;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixVente;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Client", mappedBy="favoriser")
     */
    private $clientsQuiAiment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Proposer", mappedBy="idBien")
     */
    private $propositions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commenter", mappedBy="idBien")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dependance", mappedBy="idBien")
     */
    private $dependances;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photo", mappedBy="idBien")
     */
    private $photos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeBien", inversedBy="bienImmobiliers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeBien;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Nom;

    public function __construct()
    {
        $this->clientsQuiAiment = new ArrayCollection();
        $this->propositions = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->dependances = new ArrayCollection();
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNbPieces(): ?int
    {
        return $this->nbPieces;
    }

    public function setNbPieces(int $nbPieces): self
    {
        $this->nbPieces = $nbPieces;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): self
    {
        $this->etage = $etage;

        return $this;
    }

    public function getPrixMin(): ?float
    {
        return $this->prixMin;
    }

    public function setPrixMin(float $prixMin): self
    {
        $this->prixMin = $prixMin;

        return $this;
    }

    public function getPrixMiseEnVente(): ?float
    {
        return $this->prixMiseEnVente;
    }

    public function setPrixMiseEnVente(float $prixMiseEnVente): self
    {
        $this->prixMiseEnVente = $prixMiseEnVente;
        if($this->prixMin == null)
            $this->prixMin = $prixMiseEnVente;

        return $this;
    }

    public function getDateMiseEnVente(): ?\DateTimeInterface
    {
        return $this->dateMiseEnVente;
    }

    public function setDateMiseEnVente(\DateTimeInterface $dateMiseEnVente): self
    {
        $this->dateMiseEnVente = $dateMiseEnVente;

        return $this;
    }

    public function getVisites(): ?int
    {
        return $this->visites;
    }

    public function setVisites(int $visites): self
    {
        $this->visites = $visites;

        return $this;
    }

    public function getVendue(): ?bool
    {
        return $this->vendue;
    }

    public function setVendue(bool $vendue): self
    {
        $this->vendue = $vendue;

        return $this;
    }

    public function getDateVente(): ?\DateTimeInterface
    {
        return $this->dateVente;
    }

    public function setDateVente(?\DateTimeInterface $dateVente): self
    {
        $this->dateVente = $dateVente;

        return $this;
    }

    public function getPrixVente(): ?float
    {
        return $this->prixVente;
    }

    public function setPrixVente(float $prixVente): self
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClientsQuiAiment(): Collection
    {
        return $this->clientsQuiAiment;
    }

    public function addClientsQuiAiment(Client $clientsQuiAiment): self
    {
        if (!$this->clientsQuiAiment->contains($clientsQuiAiment)) {
            $this->clientsQuiAiment[] = $clientsQuiAiment;
            $clientsQuiAiment->addFavoriser($this);
        }

        return $this;
    }

    public function removeClientsQuiAiment(Client $clientsQuiAiment): self
    {
        if ($this->clientsQuiAiment->contains($clientsQuiAiment)) {
            $this->clientsQuiAiment->removeElement($clientsQuiAiment);
            $clientsQuiAiment->removeFavoriser($this);
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
            $proposition->setIdBien($this);
        }

        return $this;
    }

    public function removeProposition(Proposer $proposition): self
    {
        if ($this->propositions->contains($proposition)) {
            $this->propositions->removeElement($proposition);
            // set the owning side to null (unless already changed)
            if ($proposition->getIdBien() === $this) {
                $proposition->setIdBien(null);
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
            $commentaire->setIdBien($this);
        }

        return $this;
    }

    public function removeCommentaire(Commenter $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdBien() === $this) {
                $commentaire->setIdBien(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dependance[]
     */
    public function getDependances(): Collection
    {
        return $this->dependances;
    }

    public function addDependance(Dependance $dependance): self
    {
        if (!$this->dependances->contains($dependance)) {
            $this->dependances[] = $dependance;
            $dependance->setIdBien($this);
        }

        return $this;
    }

    public function removeDependance(Dependance $dependance): self
    {
        if ($this->dependances->contains($dependance)) {
            $this->dependances->removeElement($dependance);
            // set the owning side to null (unless already changed)
            if ($dependance->getIdBien() === $this) {
                $dependance->setIdBien(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setIdBien($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getIdBien() === $this) {
                $photo->setIdBien(null);
            }
        }

        return $this;
    }

    public function getTypeBien(): ?TypeBien
    {
        return $this->TypeBien;
    }

    public function setTypeBien(?TypeBien $TypeBien): self
    {
        $this->TypeBien = $TypeBien;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }
}
