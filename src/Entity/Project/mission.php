<?php

namespace App\Entity\Project;

use App\Entity\Company\Company;
use App\Entity\User\User;
use App\Repository\Project\missionRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=missionRepository::class)
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"name": "ipartial"})
 */
class mission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $loaning_duration;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $loaning_start_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $loaning_active;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="missions")
     */
    private $current_company_id;

    /**
     * @ORM\OneToOne(targetEntity=Company::class, cascade={"persist", "remove"})
     */
    private $origine_company_id;

    /**
     * @ORM\ManyToOne(targetEntity=project::class, inversedBy="missions")
     */
    private $project_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoaningDuration(): ?\DateTimeInterface
    {
        return $this->loaning_duration;
    }

    public function setLoaningDuration(?\DateTimeInterface $loaning_duration): self
    {
        $this->loaning_duration = $loaning_duration;

        return $this;
    }

    public function getLoaningStartAt(): ?\DateTimeImmutable
    {
        return $this->loaning_start_at;
    }

    public function setLoaningStartAt(?\DateTimeImmutable $loaning_start_at): self
    {
        $this->loaning_start_at = $loaning_start_at;

        return $this;
    }

    public function isLoaningActive(): ?bool
    {
        return $this->loaning_active;
    }

    public function setLoaningActive(?bool $loaning_active): self
    {
        $this->loaning_active = $loaning_active;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCurrentCompanyId(): ?Company
    {
        return $this->current_company_id;
    }

    public function setCurrentCompanyId(?Company $current_company_id): self
    {
        $this->current_company_id = $current_company_id;

        return $this;
    }

    public function getOrigineCompanyId(): ?Company
    {
        return $this->origine_company_id;
    }

    public function setOrigineCompanyId(?Company $origine_company_id): self
    {
        $this->origine_company_id = $origine_company_id;

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
}
