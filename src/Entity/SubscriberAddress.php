<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SubscriberAddress
 *
 * @ORM\Table(name="02_subscriberaddress", uniqueConstraints={@ORM\UniqueConstraint(name="subsc_address_unique", columns={"id"})} )
 * @ORM\Entity(repositoryClass="App\Repository\SubscriberAddressRepository")
 */
class SubscriberAddress
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * 
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="SubscriberDetails", inversedBy="addressdetail", cascade={"persist"})
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="addresstypeid", type="smallint")
     */
    private $addresstypeid;

    /**
     * @var int
     *
     * @ORM\Column(name="verifiedid", type="boolean")
     */
    private $verifiedid;

    /**
     * @var string
     *
     * @ORM\Column(name="address1", type="string", length=255, nullable=true)
     */
    private $address1;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=255, nullable=true)
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="postalcode", type="string", length=25, nullable=true)
     */
    private $postalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="refgeoid", type="string", length=30, nullable=true)
     */
    private $refgeoid;

    /**
     * @var string
     *
     * @ORM\Column(name="preferedmethod", type="boolean")
     */
    private $preferedmethod;

    /**
     * @var string
     *
     * @ORM\Column(name="isocountrycode", type="string", length=2)
     */
    private $isocountrycode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datemodified", type="datetime", nullable=true)
     */
    private $datemodified;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

     /**
     * Set user
     *
     * @param \App\Entity\SubscriberDetails $id
     *
     * @return SubscriberOptOutDetails
     */
    public function setUser(\App\Entity\SubscriberDetails $id = null)
    {
        $this->user = $id;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\Entity\SubscriberDetails
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set addresstypeid
     *
     * @param integer $addresstypeid
     *
     * @return SubscriberAddress
     */
    public function setAddresstypeid($addresstypeid)
    {
        $this->addresstypeid = $addresstypeid;

        return $this;
    }

    /**
     * Get addresstypeid
     *
     * @return int
     */
    public function getAddresstypeid()
    {
        return $this->addresstypeid;
    }

    /**
     * Set verifiedid
     *
     * @param integer $verifiedid
     *
     * @return SubscriberAddress
     */
    public function setVerifiedid($verifiedid)
    {
        $this->verifiedid = $verifiedid;

        return $this;
    }

    /**
     * Get verifiedid
     *
     * @return int
     */
    public function getVerifiedid()
    {
        return $this->verifiedid;
    }

    /**
     * Set address1
     *
     * @param string $address1
     *
     * @return SubscriberAddress
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     *
     * @return SubscriberAddress
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return SubscriberAddress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postalcode
     *
     * @param string $postalcode
     *
     * @return SubscriberAddress
     */
    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    /**
     * Get postalcode
     *
     * @return string
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * Set refgeoid
     *
     * @param string $refgeoid
     *
     * @return SubscriberAddress
     */
    public function setRefgeoid($refgeoid)
    {
        $this->refgeoid = $refgeoid;

        return $this;
    }

    /**
     * Get refgeoid
     *
     * @return string
     */
    public function getRefgeoid()
    {
        return $this->refgeoid;
    }

    /**
     * Set preferedmethod
     *
     * @param string $preferedmethod
     *
     * @return SubscriberAddress
     */
    public function setPreferedmethod($preferedmethod)
    {
        $this->preferedmethod = $preferedmethod;

        return $this;
    }

    /**
     * Get preferedmethod
     *
     * @return string
     */
    public function getPreferedmethod()
    {
        return $this->preferedmethod;
    }

    /**
     * Set isocountrycode
     *
     * @param string $isocountrycode
     *
     * @return SubscriberAddress
     */
    public function setIsocountrycode($isocountrycode)
    {
        $this->isocountrycode = $isocountrycode;

        return $this;
    }

    /**
     * Get isocountrycode
     *
     * @return string
     */
    public function getIsocountrycode()
    {
        return $this->isocountrycode;
    }

    /**
     * Set datemodified
     *
     * @param \DateTime $datemodified
     *
     * @return SubscriberAddress
     */
    public function setDatemodified($datemodified)
    {
        $this->datemodified = $datemodified;

        return $this;
    }

    /**
     * Get datemodified
     *
     * @return \DateTime
     */
    public function getDatemodified()
    {
        return $this->datemodified;
    }
    
    
    /**
     * Set id
     *
     * @param integer $id
     *
     * @return SubscriberAddress
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
