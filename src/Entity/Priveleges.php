<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Priveleges
 *
 * @ORM\Table(name="priveleges")
 * @ORM\Entity
 */
class Priveleges
{
    /**
     * @var int
     *
     * @ORM\Column(name="privelege_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $privelegeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=11, nullable=false)
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
     * @ORM\ManyToMany(targetEntity="Roles", mappedBy="privelege")
     */
    private $role;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getPrivelegeId(): ?int
    {
        return $this->privelegeId;
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
     * @return Collection|Roles[]
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(Roles $role): self
    {
        if (!$this->role->contains($role)) {
            $this->role[] = $role;
            $role->addPrivelege($this);
        }

        return $this;
    }

    public function removeRole(Roles $role): self
    {
        if ($this->role->contains($role)) {
            $this->role->removeElement($role);
            $role->removePrivelege($this);
        }

        return $this;
    }

}
