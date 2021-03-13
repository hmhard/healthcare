<?php

namespace App\Entity;

use App\Repository\ProblemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProblemRepository::class)
 */
class Problem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $siteHistory;

    /**
     * @ORM\Column(type="text")
     */
    private $regionalProblem;

    /**
     * @ORM\Column(type="integer")
     */
    private $frequency;

    /**
     * @ORM\Column(type="text")
     */
    private $solutionsTaken;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFixed;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="problems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $department;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="problems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $postedBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiteHistory(): ?string
    {
        return $this->siteHistory;
    }

    public function setSiteHistory(string $siteHistory): self
    {
        $this->siteHistory = $siteHistory;

        return $this;
    }

    public function getRegionalProblem(): ?string
    {
        return $this->regionalProblem;
    }

    public function setRegionalProblem(string $regionalProblem): self
    {
        $this->regionalProblem = $regionalProblem;

        return $this;
    }

    public function getFrequency(): ?int
    {
        return $this->frequency;
    }

    public function setFrequency(int $frequency): self
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function getSolutionsTaken(): ?string
    {
        return $this->solutionsTaken;
    }

    public function setSolutionsTaken(string $solutionsTaken): self
    {
        $this->solutionsTaken = $solutionsTaken;

        return $this;
    }

    public function getIsFixed(): ?bool
    {
        return $this->isFixed;
    }

    public function setIsFixed(bool $isFixed): self
    {
        $this->isFixed = $isFixed;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getPostedBy(): ?User
    {
        return $this->postedBy;
    }

    public function setPostedBy(?User $postedBy): self
    {
        $this->postedBy = $postedBy;

        return $this;
    }
}
