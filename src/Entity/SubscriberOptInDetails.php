<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SubscriberOptInDetails
 *
 * @ORM\Table(name="03_subscriberoptindetails", uniqueConstraints={@ORM\UniqueConstraint(name="subsc_optin_pkey", columns={"id"})} )
 * @ORM\Entity(repositoryClass="App\Repository\SubscriberOptInDetailsRepository")
 */
class SubscriberOptInDetails
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
     * @ORM\ManyToOne(targetEntity="SubscriberDetails", inversedBy="optindetails", cascade={"persist"})
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="resourceid", type="smallint")
     */
    private $resourceid;

    /**
     * @var bool
     * @Assert\NotBlank (message ="You must agree to FinSensitive.com Terms & Conditions")
     * @ORM\Column(name="agreeterms", type="boolean")
     * 
     */
    private $agreeterms;

    /**
     * @var bool
     * @Assert\NotBlank (message ="You must agree to recieve notifications from FinSensitive.com")
     * @ORM\Column(name="agreeemails", type="boolean")
     */
    private $agreeemails;

    /**
     * @var bool
     * @Assert\NotBlank (message ="You must agree to recieve notifications from partners of FinSensitive.com")
     * @ORM\Column(name="agreepartners", type="boolean")
     */
    private $agreepartners;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="optindate", type="datetime", nullable=true)
     */
    private $optindate;

    /**
     * @var string
     *
     * @ORM\Column(name="optinip", type="string", length=50, nullable=true)
     */
    private $optinip;


    /**
     * Set id
     *
     * @param integer id
     *
     * @return SubscriberOptInDetails
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
     * Set resourceid
     *
     * @param integer $resourceid
     *
     * @return SubscriberOptInDetails
     */
    public function setResourceid($resourceid)
    {
        $this->resourceid = $resourceid;

        return $this;
    }

    /**
     * Get resourceid
     *
     * @return integer
     */
    public function getResourceid()
    {
        return $this->resourceid;
    }

    /**
     * Set agreeterms
     *
     * @param boolean $agreeterms
     *
     * @return SubscriberOptInDetails
     */
    public function setAgreeterms($agreeterms)
    {
        $this->agreeterms = $agreeterms;

        return $this;
    }

    /**
     * Get agreeterms
     *
     * @return boolean
     */
    public function getAgreeterms()
    {
        return $this->agreeterms;
    }

    /**
     * Set agreeemails
     *
     * @param boolean $agreeemails
     *
     * @return SubscriberOptInDetails
     */
    public function setAgreeemails($agreeemails)
    {
        $this->agreeemails = $agreeemails;

        return $this;
    }

    /**
     * Get agreeemails
     *
     * @return boolean
     */
    public function getAgreeemails()
    {
        return $this->agreeemails;
    }

    /**
     * Set agreepartners
     *
     * @param boolean $agreepartners
     *
     * @return SubscriberOptInDetails
     */
    public function setAgreepartners($agreepartners)
    {
        $this->agreepartners = $agreepartners;

        return $this;
    }

    /**
     * Get agreepartners
     *
     * @return boolean
     */
    public function getAgreepartners()
    {
        return $this->agreepartners;
    }

    /**
     * Set optindate
     *
     * @param \DateTime $optindate
     *
     * @return SubscriberOptInDetails
     */
    public function setOptindate($optindate)
    {
        $this->optindate = $optindate;

        return $this;
    }

    /**
     * Get optindate
     *
     * @return \DateTime
     */
    public function getOptindate()
    {
        return $this->optindate;
    }

    /**
     * Set optinip
     *
     * @param string $optinip
     *
     * @return SubscriberOptInDetails
     */
    public function setOptinip($optinip)
    {
        $this->optinip = $optinip;

        return $this;
    }

    /**
     * Get optinip
     *
     * @return string
     */
    public function getOptinip()
    {
        return $this->optinip;
    }

    /**
     * Set user
     *
     * @param \App\Entity\SubscriberDetails $id
     *
     * @return SubscriberOptInDetails
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
}
