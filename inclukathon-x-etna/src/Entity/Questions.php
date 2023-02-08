<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
class Questions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[ORM\Column(nullable: true)]
    private ?bool $enabled = null;

    #[ORM\Column(length: 3000)]
    private ?string $answerExplanation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeMedia = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PathMedia = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?ThemesIncluscore $themeIncluscore = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Propositions::class,cascade: ["remove"])]
    private Collection $propositions;

    public function __toString()
    {
    return $this->question;
    }

    public function __construct()
    {
        $this->propositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

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

    public function getAnswerExplanation(): ?string
    {
        return $this->answerExplanation;
    }

    public function setAnswerExplanation(string $answerExplanation): self
    {
        $this->answerExplanation = $answerExplanation;

        return $this;
    }

    public function getTypeMedia(): ?string
    {
        return $this->typeMedia;
    }

    public function setTypeMedia(string $typeMedia): self
    {
        $this->typeMedia = $typeMedia;

        return $this;
    }

    public function getPathMedia(): ?string
    {
        return $this->PathMedia;
    }

    public function setPathMedia(?string $PathMedia): self
    {
        $this->PathMedia = $PathMedia;

        return $this;
    }

    public function getThemeIncluscore(): ?ThemesIncluscore
    {
        return $this->themeIncluscore;
    }

    public function setThemeIncluscore(?ThemesIncluscore $themeIncluscore): self
    {
        $this->themeIncluscore = $themeIncluscore;

        return $this;
    }

    /**
     * @return Collection<int, Propositions>
     */
    public function getPropositions(): Collection
    {
        return $this->propositions;
    }

    public function addProposition(Propositions $proposition): self
    {
        if (!$this->propositions->contains($proposition)) {
            $this->propositions->add($proposition);
            $proposition->setQuestion($this);
        }

        return $this;
    }

    public function removeProposition(Propositions $proposition): self
    {
        if ($this->propositions->removeElement($proposition)) {
            // set the owning side to null (unless already changed)
            if ($proposition->getQuestion() === $this) {
                $proposition->setQuestion(null);
            }
        }

        return $this;
    }
}
