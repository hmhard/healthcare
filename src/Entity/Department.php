<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartmentRepository::class)
 */
class Department
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Problem::class, mappedBy="department")
     */
    private $problems;

    /**
     * @ORM\OneToMany(targetEntity=DepartmentHead::class, mappedBy="department")
     */
    private $departmentHeads;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="department")
     */
    private $users;

    public function __construct()
    {
        $this->problems = new ArrayCollection();
        $this->departmentHeads = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Problem[]
     */
    public function getProblems(): Collection
    {
        return $this->problems;
    }

    public function addProblem(Problem $problem): self
    {
        if (!$this->problems->contains($problem)) {
            $this->problems[] = $problem;
            $problem->setDepartment($this);
        }

        return $this;
    }

    public function removeProblem(Problem $problem): self
    {
        if ($this->problems->removeElement($problem)) {
            // set the owning side to null (unless already changed)
            if ($problem->getDepartment() === $this) {
                $problem->setDepartment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DepartmentHead[]
     */
    public function getDepartmentHeads(): Collection
    {
        return $this->departmentHeads;
    }

    public function addDepartmentHead(DepartmentHead $departmentHead): self
    {
        if (!$this->departmentHeads->contains($departmentHead)) {
            $this->departmentHeads[] = $departmentHead;
            $departmentHead->setDepartment($this);
        }

        return $this;
    }

    public function removeDepartmentHead(DepartmentHead $departmentHead): self
    {
        if ($this->departmentHeads->removeElement($departmentHead)) {
            // set the owning side to null (unless already changed)
            if ($departmentHead->getDepartment() === $this) {
                $departmentHead->setDepartment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setDepartment($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getDepartment() === $this) {
                $user->setDepartment(null);
            }
        }

        return $this;
    }
}
