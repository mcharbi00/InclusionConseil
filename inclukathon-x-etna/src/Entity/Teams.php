<?php

namespace App\Entity;

use App\Repository\TeamsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamsRepository::class)]
class Teams
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'boolean', nullable: true, options: ['default' => false])]
    private ?bool $enabled = null;

    #[ORM\Column(length: 255)]
    private ?string $projectDescription = null;

    #[ORM\ManyToOne(inversedBy: 'teams')]
    private ?Companies $companies = null;

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

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getProjectDescription(): ?string
    {
        return $this->projectDescription;
    }

    public function setProjectDescription(string $projectDescription): self
    {
        $this->projectDescription = $projectDescription;

        return $this;
    }

    public function getCompanies(): ?Companies
    {
        return $this->companies;
    }

    public function setCompanies(?Companies $companies): self
    {
        $this->companies = $companies;

        return $this;
    }
}
