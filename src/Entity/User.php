<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @Assert\Type(type="App\Entity\UserDetails")
     * @ORM\OneToOne(targetEntity=UserDetails::class, cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private ?UserDetails $userdetails;

    /**
     * @ORM\OneToMany(targetEntity=WhereMaterial::class, mappedBy="user")
     */
    private $whereMaterials;

    /**
     * @ORM\OneToMany(targetEntity=Intervention::class, mappedBy="user")
     */
    private $interventions;

    public function __construct()
    {
        $this->interventions = new ArrayCollection();
        $this->whereMaterials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserdetails(): ?UserDetails
    {
        return $this->userdetails;
    }

    public function setUserdetails(?UserDetails $userdetails): self
    {
        $this->userdetails = $userdetails;

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
            $intervention->addUser($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): self
    {
        if ($this->interventions->removeElement($intervention)) {
            $intervention->removeUser($this);
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
            $whereMaterial->setUser($this);
        }

        return $this;
    }

    public function removeWhereMaterial(WhereMaterial $whereMaterial): self
    {
        if ($this->whereMaterials->removeElement($whereMaterial)) {
            // set the owning side to null (unless already changed)
            if ($whereMaterial->getUser() === $this) {
                $whereMaterial->setUser(null);
            }
        }

        return $this;
    }
}
