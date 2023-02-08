<?php

namespace App\Entity;

use App\Repository\PropositionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropositionsRepository::class)]
class Propositions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $proposition = null;

    #[ORM\Column(nullable: true)]
    private ?bool $enabled = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isAGoodAnswer = null;

    #[ORM\ManyToOne(inversedBy: 'propositions')]
    private ?Questions $question = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $propMedia = null;

    public function __toString()
    {
    return $this->type;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getProposition(): ?string
    {
        return $this->proposition;
    }

    public function setProposition(string $proposition): self
    {
        $this->proposition = $proposition;

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

    public function isIsAGoodAnswer(): ?bool
    {
        return $this->isAGoodAnswer;
    }

    public function setIsAGoodAnswer(?bool $isAGoodAnswer): self
    {
        $this->isAGoodAnswer = $isAGoodAnswer;

        return $this;
    }

    public function getQuestion(): ?Questions
    {
        return $this->question;
    }

    public function setQuestion(?Questions $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getPropMedia(): ?string
    {
        return $this->propMedia;
    }

    public function setPropMedia(?string $propMedia): self
    {
        $this->propMedia = $propMedia;

        return $this;
    }
}
