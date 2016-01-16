<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15/01/16
 * Time: 15:08
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="personne")
 */
class Personne
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    protected $firstname;
    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastname;

    /**
     * @var date
     *
     * @ORM\Column(name="birthDate", type="date", length=255)
     * @Assert\Date()
     */
    protected $birthDate;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;


    protected $adr_id;
    protected $email;
    protected $tels;

    public function __toString(){
        return $this->getLastname()+" "+$this->getFirstname();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Personne
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Personne
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set birthDate
     *
     * @param string $birthDate
     *
     * @return Personne
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate ;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set city
     *
     * @param \AppBundle\Entity\City $city
     *
     * @return Personne
     */
    public function setCity(\AppBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \AppBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }
}
