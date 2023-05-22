<?php

namespace App\Entity\Task;

use App\Entity\Project\project;
use App\Entity\Project\projectMembers;
use App\Repository\Task\taskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=taskRepository::class)
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"name": "ipartial"})
 */
class task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=project::class, inversedBy="tasks")
     */
    private $project_id;

    /**
     * @ORM\OneToMany(targetEntity=taskSkills::class, mappedBy="task")
     */
    private $task_skill_id;

    /**
     * @ORM\ManyToMany(targetEntity=projectMembers::class, inversedBy="tasks")
     */
    private $member_id;

    public function __construct()
    {
        $this->task_skill_id = new ArrayCollection();
        $this->member_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, taskSkills>
     */
    public function getTaskSkillId(): Collection
    {
        return $this->task_skill_id;
    }

    public function addTaskSkillId(taskSkills $taskSkillId): self
    {
        if (!$this->task_skill_id->contains($taskSkillId)) {
            $this->task_skill_id[] = $taskSkillId;
            $taskSkillId->setTask($this);
        }

        return $this;
    }

    public function removeTaskSkillId(taskSkills $taskSkillId): self
    {
        if ($this->task_skill_id->removeElement($taskSkillId)) {
            // set the owning side to null (unless already changed)
            if ($taskSkillId->getTask() === $this) {
                $taskSkillId->setTask(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, projectMembers>
     */
    public function getMemberId(): Collection
    {
        return $this->member_id;
    }

    public function addMemberId(projectMembers $memberId): self
    {
        if (!$this->member_id->contains($memberId)) {
            $this->member_id[] = $memberId;
        }

        return $this;
    }

    public function removeMemberId(projectMembers $memberId): self
    {
        $this->member_id->removeElement($memberId);

        return $this;
    }
}
