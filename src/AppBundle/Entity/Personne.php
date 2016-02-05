<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15/01/16
 * Time: 15:08
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


Type::addType('enumstatus', 'AppBundle\DBAL\EnumStatusType');

/**
 * Entity of personne, main object of the address book. it has links to other object through a relationnal database
 * defined in the code (ORM annotation). Also expected values, or validation conditions are defined with Assert
 * annotation. In consequence, getter and setter are very simple.
 *
 * @ORM\Entity
 * @ORM\Table(name="personne")
 */
class Personne
{
    /**
     * Id of class
     *
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

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    protected $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="tels", type="integer", length=10)
     */
    protected $tels;

    /**
     * @ORM\ManyToOne(targetEntity="firm")
     * @ORM\JoinColumn(name="firm_id", referencedColumnName="id")
     */
    protected $firm;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255)
     * @Assert\Url(
     *      message = "The url '{{ value }}' is not a valid url",
     *     dnsMessage = "The host '{{ value }}' could not be resolved.",
     *     checkDNS = true
     * )
     */
    protected $webSite;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string",  type="enumstatus")
     *
     */
    protected $status;

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

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Personne
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tels
     *
     * @param integer $tels
     *
     * @return Personne
     */
    public function setTels($tels)
    {
        $this->tels = $tels;

        return $this;
    }

    /**
     * Get tels
     *
     * @return integer
     */
    public function getTels()
    {
        return $this->tels;
    }

    /**
     * Set webSite
     *
     * @param string $webSite
     *
     * @return Personne
     */
    public function setWebSite($webSite)
    {
        $this->webSite = $webSite;

        return $this;
    }

    /**
     * Get webSite
     *
     * @return string
     */
    public function getWebSite()
    {
        return $this->webSite;
    }

    /**
     * Set firm
     *
     * @param \AppBundle\Entity\firm $firm
     *
     * @return Personne
     */
    public function setFirm(\AppBundle\Entity\firm $firm = null)
    {
        $this->firm = $firm;

        return $this;
    }

    /**
     * Get firm
     *
     * @return \AppBundle\Entity\firm
     */
    public function getFirm()
    {
        return $this->firm;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Personne
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
