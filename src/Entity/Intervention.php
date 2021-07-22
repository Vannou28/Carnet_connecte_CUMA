<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity(repositoryClass=InterventionRepository::class)
 */
class Intervention
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $aera;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $weight;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $comment;

    /**
     * @ORM\Column(type="date")
     */
    private datetime $dateIntervention;

    /**
     * @ORM\ManyToOne(targetEntity=Material::class, inversedBy="interventions")
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="interventions")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAera(): ?float
    {
        return $this->aera;
    }

    public function setAera(?float $aera): self
    {
        $this->aera = $aera;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getDateIntervention(): ?DateTime
    {
        return $this->dateIntervention;
    }

    public function setDateIntervention(DateTime $dateIntervention): self
    {
        $this->dateIntervention = $dateIntervention;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): self
    {
        $this->dateIntervention = new DateTime('now');
        $this->material = $material;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
