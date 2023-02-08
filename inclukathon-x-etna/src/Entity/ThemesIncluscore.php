<?php

namespace App\Entity;

use App\Repository\ThemesIncluscoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemesIncluscoreRepository::class)]
class ThemesIncluscore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $enabled = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgPath = null;

    #[ORM\ManyToOne(inversedBy: 'themesIncluscores')]
    private ?Incluscore $incluscore = null;

    #[ORM\OneToMany(mappedBy: 'themeIncluscore', targetEntity: Questions::class,cascade: ["remove"])]
    private Collection $questions;

    public function __toString()
    {
    return $this->name;
    }

    public function __construct()
    {
        $this->questions = new ArrayCollection();
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

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getImgPath(): ?string
    {
        return $this->imgPath;
    }

    public function setImgPath(?string $imgPath): self
    {
        $this->imgPath = $imgPath;

        return $this;
    }

    public function getIncluscore(): ?Incluscore
    {
        return $this->incluscore;
    }

    public function setIncluscore(?Incluscore $incluscore): self
    {
        $this->incluscore = $incluscore;

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Questions $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setThemeIncluscore($this);
        }

        return $this;
    }

    public function removeQuestion(Questions $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getThemeIncluscore() === $this) {
                $question->setThemeIncluscore(null);
            }
        }

        return $this;
    }
}
