<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterialRepository::class)
 */
class Material
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $tonneUnit;

    /**
     * @ORM\OneToMany(targetEntity=Intervention::class, mappedBy="material")
     */
    private $interventions;

    /**
     * @ORM\OneToMany(targetEntity=WhereMaterial::class, mappedBy="material")
     */
    private $whereMaterials;

    public function __construct()
    {
        $this->interventions = new ArrayCollection();
        $this->whereMaterials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTonneUnit(): ?bool
    {
        return $this->tonneUnit;
    }

    public function setTonneUnit(bool $tonneUnit): self
    {
        $this->tonneUnit = $tonneUnit;

        return $this;
    }

    /**
     * @return Collection|Intervention[]
     */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(Intervention $intervention): self
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions[] = $intervention;
            $intervention->setMaterial($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): self
    {
        if ($this->interventions->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getMaterial() === $this) {
                $intervention->setMaterial(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|WhereMaterial[]
     */
    public function getWhereMaterials(): Collection
    {
        return $this->whereMaterials;
    }

    public function addWhereMaterial(WhereMaterial $whereMaterial): self
    {
        if (!$this->whereMaterials->contains($whereMaterial)) {
            $this->whereMaterials[] = $whereMaterial;
            $whereMaterial->setMaterial($this);
        }

        return $this;
    }

    public function removeWhereMaterial(WhereMaterial $whereMaterial): self
    {
        if ($this->whereMaterials->removeElement($whereMaterial)) {
            // set the owning side to null (unless already changed)
            if ($whereMaterial->getMaterial() === $this) {
                $whereMaterial->setMaterial(null);
            }
        }

        return $this;
    }
}
