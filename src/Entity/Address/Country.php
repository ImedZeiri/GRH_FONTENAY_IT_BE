<?php

namespace App\Entity\Address;

use App\Repository\Address\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 * @ApiResource(formats={"jsonld"})
 * @ApiFilter(SearchFilter::class, properties={"name": "ipartial"})
 */
class Country
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $iso_code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone_code;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="country_id")
     */
    private $addresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsoCode(): ?string
    {
        return $this->iso_code;
    }

    public function setIsoCode(?string $iso_code): self
    {
        $this->iso_code = $iso_code;

        return $this;
    }

    public function getPhoneCode(): ?string
    {
        return $this->phone_code;
    }

    public function setPhoneCode(?string $phone_code): self
    {
        $this->phone_code = $phone_code;

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setCountryId($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getCountryId() === $this) {
                $address->setCountryId(null);
            }
        }

        return $this;
    }
}
