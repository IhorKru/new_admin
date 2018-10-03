<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SubscriberDetails
 *
 * @ORM\Table(name="01_subscriberdetails", uniqueConstraints={@ORM\UniqueConstraint(name="subsc_details_pkey", columns={"id"})}, indexes={@ORM\Index(name="email_idx", columns={"emailaddress"})} )
 * @ORM\Entity(repositoryClass="App\Repository\SubscriberDetailsRepository")
 */
class SubscriberDetails
{
    
    /**
     *@ORM\OneToMany(targetEntity="SubscriberOptInDetails", mappedBy="user", cascade={"persist"})
     */
    private $optindetails;

    /**
     *@ORM\OneToMany(targetEntity="SubscriberOptOutDetails", mappedBy="user", cascade={"persist"})
     */
    private $optoutdetails;

    /**
     *@ORM\OneToMany(targetEntity="SubscriberAddress", mappedBy="user", cascade={"persist"})
     */
    private $addressdetail;

    public function __construct()
    {
        $this->optindetails = new ArrayCollection();
        $this->optoutdetails = new ArrayCollection();
        $this->addressdetail = new ArrayCollection();
    }
        
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, unique=true)
     * @ORM\Id
     *
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank (message="Complete First Name field")
     * @ORM\Column(name="firstname", type="string", length=100)
     */
    private $firstname;

    /**
     * @var string
     * @Assert\NotBlank (message="Complete Last Name field")
     * @ORM\Column(name="lastname", type="string", length=100)
     */
    private $lastname;

    /**
     * @var string
     * @Assert\NotBlank (message="Complete Email Address field")
     * @ORM\Column(name="emailaddress", type="string", length=100)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true,
     *     checkHost = true
     * )
     */
    private $emailaddress;

    /**
     * @var string
     * @Assert\NotBlank (message="Complete Mobile Phone field")
     * @ORM\Column(name="phone", type="string", length=50)
     * @Assert\Length(min=5) (message="Phone lenght must be over 5 characters")
     */
    private $phone;

    /**
     * @var int
     * @Assert\GreaterThanOrEqual("18", message="You must be 18 or over to subscribe")
     * @Assert\NotBlank (message="Complete Age field")
     * @ORM\Column(name="age", type="smallint")
     * 
     */
    private $age;

    /**
     * @var int
     *
     * @ORM\Column(name="gender", type="smallint")
     */
    private $gender;

    /**
     * @var int
     *
     * @ORM\Column(name="educationlevelid", type="smallint")
     */
    private $educationlevelid;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=255)
     */
    private $hash;
    
    /**
     * @var int
     *
     * @ORM\Column(name="sourceid", type="smallint")
     */
    private $sourceid;

    /**
     * @var int
     *
     * @ORM\Column(name="datecreated", type="datetime", nullable=false)
     */
    private $datecreated;

    /**
     * @var int
     *
     * @ORM\Column(name="dateadded", type="datetime", nullable=true)
     */
    private $dateadded;
    
    /**
     * Set id
     *
     * @param integer id
     *
     * @return SubscriberDetails
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @return SubscriberDetails
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
     * @return SubscriberDetails
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
     * Set emailaddress
     *
     * @param string $emailaddress
     *
     * @return SubscriberDetails
     */
    public function setEmailaddress($emailaddress)
    {
        $this->emailaddress = $emailaddress;

        return $this;
    }

    /**
     * Get emailaddress
     *
     * @return string
     */
    public function getEmailaddress()
    {
        return $this->emailaddress;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return SubscriberDetails
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return SubscriberDetails
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set gender
     *
     * @param integer $gender
     *
     * @return SubscriberDetails
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return integer
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set educationlevelid
     *
     * @param integer $educationlevelid
     *
     * @return SubscriberDetails
     */
    public function setEducationlevelid($educationlevelid)
    {
        $this->educationlevelid = $educationlevelid;

        return $this;
    }

    /**
     * Get educationlevelid
     *
     * @return integer
     */
    public function getEducationlevelid()
    {
        return $this->educationlevelid;
    }

    /**
     * Set hash
     *
     * @param string $hash
     *
     * @return SubscriberDetails
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }
    
    
    public function getOptindetails()
    {
        return $this->optindetails;
    }
    
    public function setOptindetails(ArrayCollection $optindetails)
    {
        $this->optindetails = $optindetails;
    }

    /**
     * Add optindetail
     *
     * @param \App\Entity\SubscriberOptInDetails $optindetail
     *
     * @return SubscriberDetails
     */
    public function addOptindetail(\App\Entity\SubscriberOptInDetails $optindetail)
    {
        $this->optindetails[] = $optindetail;

        return $this;
    }

    /**
     * Remove optindetail
     *
     * @param \App\Entity\SubscriberOptInDetails $optindetail
     */
    public function removeOptindetail(\App\Entity\SubscriberOptInDetails $optindetail)
    {
        $this->optindetails->removeElement($optindetail);
    }

    /**
     * Set sourceid
     *
     * @param integer $sourceid
     *
     * @return SubscriberDetails
     */
    public function setSourceid($sourceid)
    {
        $this->sourceid = $sourceid;

        return $this;
    }

    /**
     * Get sourceid
     *
     * @return integer
     */
    public function getSourceid()
    {
        return $this->sourceid;
    }

    /**
     * Add addressdetail
     *
     * @param \App\Entity\SubscriberAddress $addressdetail
     *
     * @return SubscriberDetails
     */
    public function addAddressdetail(\App\Entity\SubscriberAddress $addressdetail)
    {
        $this->addressdetail[] = $addressdetail;

        return $this;
    }

    /**
     * Remove addressdetail
     *
     * @param \App\Entity\SubscriberAddress $addressdetail
     */
    public function removeAddressdetail(\App\Entity\SubscriberAddress $addressdetail)
    {
        $this->addressdetail->removeElement($addressdetail);
    }

    /**
     * Get addressdetail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddressdetail()
    {
        return $this->addressdetail;
    }


    /**
     * Set datecreated
     *
     * @param \datetime $datecreated
     *
     * @return SubscriberDetails
     */
    public function setDatecreated(\datetime $datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    /**
     * Get datecreated
     *
     * @return \datetime
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

        /**
     * Set dateadded
     *
     * @param \datetime $dateadded
     *
     * @return SubscriberDetails
     */
    public function setDateadded(\datetime $dateadded)
    {
        $this->dateadded = $dateadded;

        return $this;
    }

    /**
     * Get dateadded
     *
     * @return \datetime
     */
    public function getDateadded()
    {
        return $this->dateadded;
    }

    /**
     * Add optoutdetail
     *
     * @param \App\Entity\SubscriberOptOutDetails $optoutdetail
     *
     * @return SubscriberDetails
     */
    public function addOptoutdetail(\App\Entity\SubscriberOptOutDetails $optoutdetail)
    {
        $this->optoutdetails[] = $optoutdetail;

        return $this;
    }

    /**
     * Remove optoutdetail
     *
     * @param \App\Entity\SubscriberOptOutDetails $optoutdetail
     */
    public function removeOptoutdetail(\App\Entity\SubscriberOptOutDetails $optoutdetail)
    {
        $this->optoutdetails->removeElement($optoutdetail);
    }

    /**
     * Get optoutdetails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOptoutdetails()
    {
        return $this->optoutdetails;
    }
}
