<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15/01/16
 * Time: 15:08.
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

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
     * Id of class.
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
     * @ORM\ManyToOne(targetEntity="City",inversedBy="personnes")
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
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", length=10)
     */
    protected $telephone;

    /**
     * @ORM\ManyToOne(targetEntity="Firm")
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

    const STATUS_PRO = 'professionnel';
    const STATUS_PART = 'particulier';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string")
     * Assert\NotBlank()
     */
    protected $status;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getLastname().' '.$this->getFirstname();
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
     * Set firstname.
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
     * Get firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname.
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
     * Get lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set birthDate.
     *
     * @param string $birthDate
     *
     * @return Personne
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate.
     *
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set city.
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
     * Get city.
     *
     * @return \AppBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set email.
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
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telephone.
     *
     * @param int $telephone
     *
     * @return Personne
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone.
     *
     * @return int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set webSite.
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
     * Get webSite.
     *
     * @return string
     */
    public function getWebSite()
    {
        return $this->webSite;
    }

    /**
     * Set firm.
     *
     * @param \AppBundle\Entity\Firm $firm
     *
     * @return Personne
     */
    public function setFirm(\AppBundle\Entity\Firm $firm = null)
    {
        $this->firm = $firm;

        return $this;
    }

    /**
     * Get firm.
     *
     * @return \AppBundle\Entity\firm
     */
    public function getFirm()
    {
        return $this->firm;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Personne
     */
    public function setStatus(string $status)
    {
        if (!in_array($status, array('1', '2'))) {
            throw new \InvalidArgumentException('Invalid status, expected 1 or 2, got '.$status);
        }
        $this->status = $status;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getNamedStatus()
    {
        switch ($this->status) {
            case '1':
                return self::STATUS_PART;
                break;
            case '2':
                return self::STATUS_PRO;
            break;
        };

        return 'Not defined';
    }
}
