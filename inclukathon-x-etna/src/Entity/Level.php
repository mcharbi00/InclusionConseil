<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Companies::class, inversedBy: 'levels')]
    private Collection $company;

    public function __construct()
    {
        $this->company = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
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

    /**
     * @return Collection<int, Companies>
     */
    public function getCompany(): Collection
    {
        return $this->company;
    }

    public function addCompany(Companies $company): self
    {
        if (!$this->company->contains($company)) {
            $this->company->add($company);
        }

        return $this;
    }

    public function removeCompany(Companies $company): self
    {
        $this->company->removeElement($company);

        return $this;
    }
}
