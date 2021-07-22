<?php

namespace App\Entity;

use App\Repository\WhereMaterialRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity(repositoryClass=WhereMaterialRepository::class)
 */
class WhereMaterial
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $takeDate;

    /**
     * @ORM\ManyToOne(targetEntity=Material::class, inversedBy="whereMaterials")
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="whereMaterials")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTakeDate(): ?DateTime
    {
        return $this->takeDate;
    }

    public function setTakeDate(?DateTime $takeDate): self
    {
        $this->takeDate = $takeDate;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): self
    {
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
