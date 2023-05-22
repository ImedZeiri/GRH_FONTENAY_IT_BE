<?php

namespace App\Entity\Company;

use App\Entity\Project\mission;
use App\Repository\Company\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


 /**
 * @ORM\Entity(repositoryClass=App\Repository\Company\CompanyRepository::class)
 * @ORM\Table(name="`company`")
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"name": "ipartial"})
 */
class Company
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacity;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $deleted_file_expiration;

    /**
     * @ORM\Column(type="integer")
     */
    private $tax_number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $identity_number;

    /**
     * @ORM\OneToMany(targetEntity=Department::class, mappedBy="company_id")
     */
    private $departments;

    /**
     * @ORM\OneToMany(targetEntity=CompanyAssociate::class, mappedBy="company_id")
     */
    private $companyAssociates;

    /**
     * @ORM\OneToMany(targetEntity=mission::class, mappedBy="current_company_id")
     */
    private $missions;

    public function __construct()
    {
        $this->departments = new ArrayCollection();
        $this->companyAssociates = new ArrayCollection();
        $this->missions = new ArrayCollection();
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getDeletedFileExpiration(): ?\DateTimeInterface
    {
        return $this->deleted_file_expiration;
    }

    public function setDeletedFileExpiration(?\DateTimeInterface $deleted_file_expiration): self
    {
        $this->deleted_file_expiration = $deleted_file_expiration;

        return $this;
    }

    public function getTaxNumber(): ?int
    {
        return $this->tax_number;
    }

    public function setTaxNumber(int $tax_number): self
    {
        $this->tax_number = $tax_number;

        return $this;
    }

    public function getIdentityNumber(): ?int
    {
        return $this->identity_number;
    }

    public function setIdentityNumber(?int $identity_number): self
    {
        $this->identity_number = $identity_number;

        return $this;
    }

    /**
     * @return Collection<int, Department>
     */
    public function getDepartments(): Collection
    {
        return $this->departments;
    }

    public function addDepartment(Department $department): self
    {
        if (!$this->departments->contains($department)) {
            $this->departments[] = $department;
            $department->setCompanyId($this);
        }

        return $this;
    }

    public function removeDepartment(Department $department): self
    {
        if ($this->departments->removeElement($department)) {
            // set the owning side to null (unless already changed)
            if ($department->getCompanyId() === $this) {
                $department->setCompanyId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompanyAssociate>
     */
    public function getCompanyAssociates(): Collection
    {
        return $this->companyAssociates;
    }

    public function addCompanyAssociate(CompanyAssociate $companyAssociate): self
    {
        if (!$this->companyAssociates->contains($companyAssociate)) {
            $this->companyAssociates[] = $companyAssociate;
            $companyAssociate->setCompanyId($this);
        }

        return $this;
    }

    public function removeCompanyAssociate(CompanyAssociate $companyAssociate): self
    {
        if ($this->companyAssociates->removeElement($companyAssociate)) {
            // set the owning side to null (unless already changed)
            if ($companyAssociate->getCompanyId() === $this) {
                $companyAssociate->setCompanyId(null);
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
            $mission->setCurrentCompanyId($this);
        }

        return $this;
    }

    public function removeMission(mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getCurrentCompanyId() === $this) {
                $mission->setCurrentCompanyId(null);
            }
        }

        return $this;
    }
}
