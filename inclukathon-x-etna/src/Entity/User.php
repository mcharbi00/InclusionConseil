<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $avatarImgPath = null;

    #[ORM\Column(length: 255)]
    private ?string $lang = null;

    #[ORM\Column]
    private ?int $teamId = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hasAPassword = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?bool $enabled = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $pwd = null;

    #[ORM\Column]
    private ?bool $superAdmin = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Companies $companies = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvatarImgPath(): ?string
    {
        return $this->avatarImgPath;
    }

    public function setAvatarImgPath(string $avatarImgPath): self
    {
        $this->avatarImgPath = $avatarImgPath;

        return $this;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    public function getTeamId(): ?int
    {
        return $this->teamId;
    }

    public function setTeamId(int $teamId): self
    {
        $this->teamId = $teamId;

        return $this;
    }

    public function isHasAPassword(): ?bool
    {
        return $this->hasAPassword;
    }

    public function setHasAPassword(?bool $hasAPassword): self
    {
        $this->hasAPassword = $hasAPassword;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    public function setPwd(string $pwd): self
    {
        $this->pwd = $pwd;

        return $this;
    }

    public function isSuperAdmin(): ?bool
    {
        return $this->superAdmin;
    }

    public function setSuperAdmin(bool $superAdmin): self
    {
        $this->superAdmin = $superAdmin;

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
