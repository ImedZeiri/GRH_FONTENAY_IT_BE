<?php

namespace App\Entity\Project;

use App\Entity\Task\task;
use App\Entity\User\User;
use App\Repository\Project\projectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ORM\Entity(repositoryClass=projectRepository::class)
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"name": "ipartial"})
 */
class project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="projects")
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity=task::class, mappedBy="project_id")
     */
    private $tasks;

    /**
     * @ORM\OneToMany(targetEntity=projectMembers::class, mappedBy="project_id")
     */
    private $projectMembers;

    /**
     * @ORM\OneToMany(targetEntity=mission::class, mappedBy="project_id")
     */
    private $missions;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="projects")
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $start_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $end_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $field;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->projectMembers = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setProjectId($this);
        }

        return $this;
    }

    public function removeTask(task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getProjectId() === $this) {
                $task->setProjectId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, projectMembers>
     */
    public function getProjectMembers(): Collection
    {
        return $this->projectMembers;
    }

    public function addProjectMember(projectMembers $projectMember): self
    {
        if (!$this->projectMembers->contains($projectMember)) {
            $this->projectMembers[] = $projectMember;
            $projectMember->setProjectId($this);
        }

        return $this;
    }

    public function removeProjectMember(projectMembers $projectMember): self
    {
        if ($this->projectMembers->removeElement($projectMember)) {
            // set the owning side to null (unless already changed)
            if ($projectMember->getProjectId() === $this) {
                $projectMember->setProjectId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, mission>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setProjectId($this);
        }

        return $this;
    }

    public function removeMission(mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getProjectId() === $this) {
                $mission->setProjectId(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->start_at;
    }

    public function setStartAt(\DateTimeImmutable $start_at): self
    {
        $this->start_at = $start_at;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->end_at;
    }

    public function setEndAt(\DateTimeImmutable $end_at): self
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function getField(): ?string
    {
        return $this->field;
    }

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }
}
