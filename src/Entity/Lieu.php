<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LieuRepository")
 */
class Lieu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="lieu_depart")
     */
    private $departTrajets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="lieu")
     */
    private $arriveeTrajets;

    public function __construct()
    {
        $this->departTrajets = new ArrayCollection();
        $this->arriveeTrajets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getTrajets(): Collection
    {
        return $this->departTrajets;
    }

    public function addTrajet(Trajet $trajet): self
    {
        if (!$this->departTrajets->contains($trajet)) {
            $this->departTrajets[] = $trajet;
            $trajet->setLieuDepart($this);
        }

        return $this;
    }

    public function removeTrajet(Trajet $trajet): self
    {
        if ($this->departTrajets->contains($trajet)) {
            $this->departTrajets->removeElement($trajet);
            // set the owning side to null (unless already changed)
            if ($trajet->getLieuDepart() === $this) {
                $trajet->setLieuDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getArriveeTrajets(): Collection
    {
        return $this->arriveeTrajets;
    }

    public function addArriveeTrajet(Trajet $arriveeTrajet): self
    {
        if (!$this->arriveeTrajets->contains($arriveeTrajet)) {
            $this->arriveeTrajets[] = $arriveeTrajet;
            $arriveeTrajet->setLieu($this);
        }

        return $this;
    }

    public function removeArriveeTrajet(Trajet $arriveeTrajet): self
    {
        if ($this->arriveeTrajets->contains($arriveeTrajet)) {
            $this->arriveeTrajets->removeElement($arriveeTrajet);
            // set the owning side to null (unless already changed)
            if ($arriveeTrajet->getLieu() === $this) {
                $arriveeTrajet->setLieu(null);
            }
        }

        return $this;
    }
}
