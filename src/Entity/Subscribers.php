<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscribers
 *
 * @ORM\Table(name="subscribers", indexes={@ORM\Index(name="email_idx", columns={"email"})})
 * @ORM\Entity(repositoryClass="App\Repository\SubscribersRepository")
 */
class Subscribers
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, unique=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     * 
     */
    private $id;
    /**
     * @var integer
     *
     * @ORM\Column(name="userID", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $emailaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_fields", type="text")
     */
    private $custom_fields;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Lists", inversedBy="subscribers", cascade={"persist"})
     * @ORM\JoinColumn(name="list", referencedColumnName="id")
     */
    private $list;

    /**
     * @var integer
     *
     * @ORM\Column(name="unsubscribed", type="integer", nullable=true)
     */
    private $unsubscribed;

    /**
     * @var integer
     *
     * @ORM\Column(name="bounced", type="integer", nullable=true)
     */
    private $bounced;

    /**
     * @var integer
     *
     * @ORM\Column(name="bounce_soft", type="integer", nullable=true)
     */
    private $bounce_soft;

    /**
     * @var integer
     *
     * @ORM\Column(name="complaint", type="integer", nullable=true)
     */
    private $complaint;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_campaign", type="integer", nullable=true)
     */
    private $last_campaign;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_ares", type="integer", nullable=true)
     */
    private $last_ares;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime", nullable=true)
     */
    private $timestamp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="join_date", type="datetime", nullable=true)
     */
    private $join_date;

    /**
     * @var integer
     *
     * @ORM\Column(name="confirmed", type="integer", nullable=true)
     */
    private $confirmed;

    /**
     * @var string
     *
     * @ORM\Column(name="messageID", type="string", length=100)
     */
    private $messageID;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Subscribers
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
     * Set userid
     *
     * @param integer $userid
     *
     * @return Subscribers
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Subscribers
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set emailaddress
     *
     * @param string $emailaddress
     *
     * @return Subscribers
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
     * Set customFields
     *
     * @param \text $customFields
     *
     * @return Subscribers
     */
    public function setCustomFields($customFields)
    {
        $this->custom_fields = $customFields;

        return $this;
    }

    /**
     * Get customFields
     *
     * @return \text
     */
    public function getCustomFields()
    {
        return $this->custom_fields;
    }

    /**
     * Set list
     *
     * @param integer $list
     *
     * @return Subscribers
     */
    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get list
     *
     * @return integer
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Set unsubscribed
     *
     * @param integer $unsubscribed
     *
     * @return Subscribers
     */
    public function setUnsubscribed($unsubscribed)
    {
        $this->unsubscribed = $unsubscribed;

        return $this;
    }

    /**
     * Get unsubscribed
     *
     * @return integer
     */
    public function getUnsubscribed()
    {
        return $this->unsubscribed;
    }

    /**
     * Set bounced
     *
     * @param integer $bounced
     *
     * @return Subscribers
     */
    public function setBounced($bounced)
    {
        $this->bounced = $bounced;

        return $this;
    }

    /**
     * Get bounced
     *
     * @return integer
     */
    public function getBounced()
    {
        return $this->bounced;
    }

    /**
     * Set bounceSoft
     *
     * @param integer $bounceSoft
     *
     * @return Subscribers
     */
    public function setBounceSoft($bounceSoft)
    {
        $this->bounce_soft = $bounceSoft;

        return $this;
    }

    /**
     * Get bounceSoft
     *
     * @return integer
     */
    public function getBounceSoft()
    {
        return $this->bounce_soft;
    }

    /**
     * Set complaint
     *
     * @param integer $complaint
     *
     * @return Subscribers
     */
    public function setComplaint($complaint)
    {
        $this->complaint = $complaint;

        return $this;
    }

    /**
     * Get complaint
     *
     * @return integer
     */
    public function getComplaint()
    {
        return $this->complaint;
    }

    /**
     * Set lastCampaign
     *
     * @param integer $lastCampaign
     *
     * @return Subscribers
     */
    public function setLastCampaign($lastCampaign)
    {
        $this->last_campaign = $lastCampaign;

        return $this;
    }

    /**
     * Get lastCampaign
     *
     * @return integer
     */
    public function getLastCampaign()
    {
        return $this->last_campaign;
    }

    /**
     * Set lastAres
     *
     * @param integer $lastAres
     *
     * @return Subscribers
     */
    public function setLastAres($lastAres)
    {
        $this->last_ares = $lastAres;

        return $this;
    }

    /**
     * Get lastAres
     *
     * @return integer
     */
    public function getLastAres()
    {
        return $this->last_ares;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return Subscribers
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set joinDate
     *
     * @param \DateTime $joinDate
     *
     * @return Subscribers
     */
    public function setJoinDate($joinDate)
    {
        $this->join_date = $joinDate;

        return $this;
    }

    /**
     * Get joinDate
     *
     * @return \DateTime
     */
    public function getJoinDate()
    {
        return $this->join_date;
    }

    /**
     * Set confirmed
     *
     * @param integer $confirmed
     *
     * @return Subscribers
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get confirmed
     *
     * @return integer
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Set messageID
     *
     * @param string $messageID
     *
     * @return Subscribers
     */
    public function setMessageID($messageID)
    {
        $this->messageID = $messageID;

        return $this;
    }

    /**
     * Get messageID
     *
     * @return string
     */
    public function getMessageID()
    {
        return $this->messageID;
    }
}
