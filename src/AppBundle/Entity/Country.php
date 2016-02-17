<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Country.
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Entity\CountryRepository")
 */
class Country
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     * @ORM\OneToMany(targetEntity="Region", mappedBy="country")
     */
    private $regions;

    public function __construct()
    {
        $this->regions = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add region.
     *
     * @param \AppBundle\Entity\Region $region
     *
     * @return Country
     */
    public function addRegion(\AppBundle\Entity\Region $region)
    {
        $this->regions[] = $region;

        return $this;
    }

    /**
     * Remove region.
     *
     * @param \AppBundle\Entity\Region $region
     */
    public function removeRegion(\AppBundle\Entity\Region $region)
    {
        $this->regions->removeElement($region);
    }

    /**
     * Get regions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegions()
    {
        return $this->regions;
    }
}
