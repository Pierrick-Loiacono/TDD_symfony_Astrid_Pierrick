<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrajetRepository")
 */
class Trajet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="trajets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lieu_depart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="trajets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lieu_arrive;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $places;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="trajets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $conducteur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="trajets")
     */
    private $passagers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="arriveeTrajets")
     */
    private $lieu;

    public function __construct()
    {
        $this->passagers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieuDepart(): ?Lieu
    {
        return $this->lieu_depart;
    }

    public function setLieuDepart(?Lieu $lieu_depart): self
    {
        $this->lieu_depart = $lieu_depart;

        return $this;
    }

    public function getLieuArrive(): ?Lieu
    {
        return $this->lieu_arrive;
    }

    public function setLieuArrive(?Lieu $lieu_arrive): self
    {
        $this->lieu_arrive = $lieu_arrive;

        return $this;
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

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): self
    {
        $this->places = $places;

        return $this;
    }

    public function getConducteur(): ?User
    {
        return $this->conducteur;
    }

    public function setConducteur(?User $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getPassagers(): Collection
    {
        return $this->passagers;
    }

    public function addPassager(User $passager): self
    {
        if (!$this->passagers->contains($passager)) {
            $this->passagers[] = $passager;
        }

        return $this;
    }

    public function removePassager(User $passager): self
    {
        if ($this->passagers->contains($passager)) {
            $this->passagers->removeElement($passager);
        }

        return $this;
    }

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }
}
