<?php

namespace App\Entity\Project;

use App\Entity\Task\task;
use App\Repository\Project\projectMembersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ORM\Entity(repositoryClass=projectMembersRepository::class)
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"name": "ipartial"})
 */
class projectMembers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity=project::class, inversedBy="projectMembers")
     */
    private $project_id;

    /**
     * @ORM\ManyToMany(targetEntity=task::class, mappedBy="member_id")
     */
    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getProjectId(): ?project
    {
        return $this->project_id;
    }

    public function setProjectId(?project $project_id): self
    {
        $this->project_id = $project_id;

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
            $task->addMemberId($this);
        }

        return $this;
    }

    public function removeTask(task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            $task->removeMemberId($this);
        }

        return $this;
    }
}
