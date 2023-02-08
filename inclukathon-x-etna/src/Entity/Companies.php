<?php

namespace App\Entity;

use App\Repository\CompaniesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompaniesRepository::class)]
class Companies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgPath = null;

    #[ORM\OneToMany(mappedBy: 'companies', targetEntity: Teams::class)]
    private Collection $teams;

    #[ORM\OneToMany(mappedBy: 'companies', targetEntity: User::class)]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Level::class, mappedBy: 'company')]
    private Collection $levels;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Incluscore::class)]
    private Collection $incluscores;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->levels = new ArrayCollection();
        $this->incluscores = new ArrayCollection();
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



    public function getImgPath(): ?string
    {
        return $this->imgPath;
    }

    public function setImgPath(string $imgPath): self
    {
        $this->imgPath = $imgPath;

        return $this;
    }

    /**
     * @return Collection<int, Teams>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Teams $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->setCompanies($this);
        }

        return $this;
    }

    public function removeTeam(Teams $team): self
    {
        if ($this->teams->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getCompanies() === $this) {
                $team->setCompanies(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCompanies($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCompanies() === $this) {
                $user->setCompanies(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Level>
     */
    public function getLevels(): Collection
    {
        return $this->levels;
    }

    public function addLevel(Level $level): self
    {
        if (!$this->levels->contains($level)) {
            $this->levels->add($level);
            $level->addCompany($this);
        }

        return $this;
    }

    public function removeLevel(Level $level): self
    {
        if ($this->levels->removeElement($level)) {
            $level->removeCompany($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Incluscore>
     */
    public function getIncluscores(): Collection
    {
        return $this->incluscores;
    }

    public function addIncluscore(Incluscore $incluscore): self
    {
        if (!$this->incluscores->contains($incluscore)) {
            $this->incluscores->add($incluscore);
            $incluscore->setCompany($this);
        }

        return $this;
    }

    public function removeIncluscore(Incluscore $incluscore): self
    {
        if ($this->incluscores->removeElement($incluscore)) {
            // set the owning side to null (unless already changed)
            if ($incluscore->getCompany() === $this) {
                $incluscore->setCompany(null);
            }
        }

        return $this;
    }
}
