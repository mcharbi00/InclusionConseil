<?php

namespace App\Entity;

use App\Repository\IncluscoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IncluscoreRepository::class)]
class Incluscore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $smallName = null;

    #[ORM\Column(nullable: true)]
    private ?bool $enabled = null;

    #[ORM\Column(nullable: true)]
    private ?bool $canBePublic = null;

    #[ORM\Column(length: 3000, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isInclucard = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $inclucardColor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $incluscoreColor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondIncluscoreColor = null;

    #[ORM\Column(nullable: true)]
    private ?bool $displayNewStudentNumber = null;

    #[ORM\OneToMany(mappedBy: 'incluscore', targetEntity: ThemesIncluscore::class, cascade: ["remove"])]
    private Collection $themesIncluscores;

    public function __toString()
    {
    return $this->name;
    }
    public function __construct()
    {
        $this->themesIncluscores = new ArrayCollection();
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

    public function getSmallName(): ?string
    {
        return $this->smallName;
    }

    public function setSmallName(string $smallName): self
    {
        $this->smallName = $smallName;

        return $this;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function isCanBePublic(): ?bool
    {
        return $this->canBePublic;
    }

    public function setCanBePublic(?bool $canBePublic): self
    {
        $this->canBePublic = $canBePublic;

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

    public function isIsInclucard(): ?bool
    {
        return $this->isInclucard;
    }

    public function setIsInclucard(?bool $isInclucard): self
    {
        $this->isInclucard = $isInclucard;

        return $this;
    }

    public function getInclucardColor(): ?string
    {
        return $this->inclucardColor;
    }

    public function setInclucardColor(?string $inclucardColor): self
    {
        $this->inclucardColor = $inclucardColor;

        return $this;
    }

    public function getIncluscoreColor(): ?string
    {
        return $this->incluscoreColor;
    }

    public function setIncluscoreColor(?string $incluscoreColor): self
    {
        $this->incluscoreColor = $incluscoreColor;

        return $this;
    }

    public function getSecondIncluscoreColor(): ?string
    {
        return $this->secondIncluscoreColor;
    }

    public function setSecondIncluscoreColor(?string $secondIncluscoreColor): self
    {
        $this->secondIncluscoreColor = $secondIncluscoreColor;

        return $this;
    }

    public function isDisplayNewStudentNumber(): ?bool
    {
        return $this->displayNewStudentNumber;
    }

    public function setDisplayNewStudentNumber(?bool $displayNewStudentNumber): self
    {
        $this->displayNewStudentNumber = $displayNewStudentNumber;

        return $this;
    }

    /**
     * @return Collection<int, ThemesIncluscore>
     */
    public function getThemesIncluscores(): Collection
    {
        return $this->themesIncluscores;
    }

    public function addThemesIncluscore(ThemesIncluscore $themesIncluscore): self
    {
        if (!$this->themesIncluscores->contains($themesIncluscore)) {
            $this->themesIncluscores->add($themesIncluscore);
            $themesIncluscore->setIncluscore($this);
        }

        return $this;
    }

    public function removeThemesIncluscore(ThemesIncluscore $themesIncluscore): self
    {
        if ($this->themesIncluscores->removeElement($themesIncluscore)) {
            // set the owning side to null (unless already changed)
            if ($themesIncluscore->getIncluscore() === $this) {
                $themesIncluscore->setIncluscore(null);
            }
        }

        return $this;
    }
}
