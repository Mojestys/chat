<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity
 */
class Roles
{
    /**
     * @var int
     *
     * @ORM\Column(name="role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roleId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=32, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=32, nullable=false)
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Priveleges", inversedBy="role")
     * @ORM\JoinTable(name="roles_priveleges",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="privelege_id", referencedColumnName="privelege_id")
     *   }
     * )
     */
    private $privelege;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Users", mappedBy="role")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->privelege = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getRoleId(): ?int
    {
        return $this->roleId;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Priveleges[]
     */
    public function getPrivelege(): Collection
    {
        return $this->privelege;
    }

    public function addPrivelege(Priveleges $privelege): self
    {
        if (!$this->privelege->contains($privelege)) {
            $this->privelege[] = $privelege;
        }

        return $this;
    }

    public function removePrivelege(Priveleges $privelege): self
    {
        if ($this->privelege->contains($privelege)) {
            $this->privelege->removeElement($privelege);
        }

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Users $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->addRole($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            $user->removeRole($this);
        }

        return $this;
    }

}
