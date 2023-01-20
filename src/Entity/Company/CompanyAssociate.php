<?php

namespace App\Entity\Company;

use App\Entity\User\User;
use App\Repository\Company\CompanyAssociateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=CompanyAssociateRepository::class)
 * @ApiResource(formats={"jsonld"})
 * @ApiFilter(SearchFilter::class, properties={"principal": "ipartial"})
 */
class CompanyAssociate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $principal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $social_part;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="companyAssociates")
     */
    private $company_id;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="companyAssociate")
     */
    private $user_id;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrincipal(): ?string
    {
        return $this->principal;
    }

    public function setPrincipal(?string $principal): self
    {
        $this->principal = $principal;

        return $this;
    }

    public function getSocialPart(): ?int
    {
        return $this->social_part;
    }

    public function setSocialPart(?int $social_part): self
    {
        $this->social_part = $social_part;

        return $this;
    }

    public function getCompanyId(): ?Company
    {
        return $this->company_id;
    }

    public function setCompanyId(?Company $company_id): self
    {
        $this->company_id = $company_id;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id[] = $userId;
            $userId->setCompanyAssociate($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getCompanyAssociate() === $this) {
                $userId->setCompanyAssociate(null);
            }
        }

        return $this;
    }
}
