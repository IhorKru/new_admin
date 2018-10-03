<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaignInputDetails
 *
 * @ORM\Table(name="07_campaigninputdetails", uniqueConstraints={@ORM\UniqueConstraint(name="camp_input_details_pkey", columns={"id"})} )
 * @ORM\Entity(repositoryClass="App\Repository\CampaignInputDetailsRepository")
 */
class CampaignInputDetails
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
     * @var string
     *
     * @ORM\Column(name="traffic_type", type="string", length=255)
     */
    private $traffic_type;

    /**
     * @var string
     *
     * @ORM\Column(name="partnername", type="string", length=255)
     */
    private $partnername;

    /**
     * @var string
     *
     * @ORM\Column(name="resourcename", type="string", length=255)
     */
    private $resourcename;

    /**
     * @var string
     *
     * @ORM\Column(name="templatename", type="string", length=255)
     */
    private $templatename;

    /**
     * @var int
     *
     * @ORM\Column(name="numemails", type="integer")
     */
    private $numemails;
    
    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=255)
     */
    private $timezone;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetosend", type="datetime", length=255)
     */
    private $datetosend;

    /**
     * @var string
     *
     * @ORM\Column(name="geo", type="string", length=255)
     */
    private $geo;

    /**
     * @var string
     *
     * @ORM\Column(name="link1", type="text")
     */
    private $link1;

    /**
     * @var string
     *
     * @ORM\Column(name="link2", type="text")
     */
    private $link2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime", length=255)
     */
    private $datecreated;

    /**
     * @var int
     *
     * @ORM\Column(name="campaigns", type="integer")
     */
    private $campaigns;

    /**
     * @var int
     *
     * @ORM\Column(name="emailssent", type="integer")
     */
    private $emailssent;

    /**
     * @var int
     *
     * @ORM\Column(name="bounces", type="integer")
     */
    private $bounces;

    /**
     * @var int
     *
     * @ORM\Column(name="sbounces", type="integer")
     */
    private $sbounces;

    /**
     * @var int
     *
     * @ORM\Column(name="complaints", type="integer")
     */
    private $complaints;

    /**
     * @var int
     *
     * @ORM\Column(name="opens", type="integer")
     */
    private $opens;

    /**
     * @var int
     *
     * @ORM\Column(name="clicks", type="integer")
     */
    private $clicks;

    /**
     * @var int
     *
     * @ORM\Column(name="spend", type="integer")
     */
    private $spend;

    /**
     * @var int
     *
     * @ORM\Column(name="revenue", type="integer")
     */
    private $revenue;

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
     * Set partnername
     *
     * @param string $partnername
     *
     * @return CampaignInputDetails
     */
    public function setPartnername($partnername)
    {
        $this->partnername = $partnername;

        return $this;
    }

    /**
     * Get partnername
     *
     * @return string
     */
    public function getPartnername()
    {
        return $this->partnername;
    }

    /**
     * Set numemails
     *
     * @param integer $numemails
     *
     * @return CampaignInputDetails
     */
    public function setNumemails($numemails)
    {
        $this->numemails = $numemails;

        return $this;
    }

    /**
     * Get numemails
     *
     * @return int
     */
    public function getNumemails()
    {
        return $this->numemails;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return CampaignInputDetails
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set resourcename
     *
     * @param string $resourcename
     *
     * @return CampaignInputDetails
     */
    public function setResourcename($resourcename)
    {
        $this->resourcename = $resourcename;

        return $this;
    }

    /**
     * Get resourcename
     *
     * @return string
     */
    public function getResourcename()
    {
        return $this->resourcename;
    }

    /**
     * Set templatename
     *
     * @param string $templatename
     *
     * @return CampaignInputDetails
     */
    public function setTemplatename($templatename)
    {
        $this->templatename = $templatename;

        return $this;
    }

    /**
     * Get templatename
     *
     * @return string
     */
    public function getTemplatename()
    {
        return $this->templatename;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     *
     * @return CampaignInputDetails
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set datetosend
     *
     * @param \DateTime $datetosend
     *
     * @return CampaignInputDetails
     */
    public function setDatetosend($datetosend)
    {
        $this->datetosend = $datetosend;

        return $this;
    }

    /**
     * Get datetosend
     *
     * @return \DateTime
     */
    public function getDatetosend()
    {
        return $this->datetosend;
    }


    /**
     * Set geo
     *
     * @param string $geo
     *
     * @return CampaignInputDetails
     */
    public function setGeo($geo)
    {
        $this->geo = $geo;

        return $this;
    }

    /**
     * Get geo
     *
     * @return string
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * Set link1
     *
     * @param string $link1
     *
     * @return CampaignInputDetails
     */
    public function setLink1($link1)
    {
        $this->link1 = $link1;

        return $this;
    }

    /**
     * Get link1
     *
     * @return string
     */
    public function getLink1()
    {
        return $this->link1;
    }

    /**
     * Set link2
     *
     * @param string $link2
     *
     * @return CampaignInputDetails
     */
    public function setLink2($link2)
    {
        $this->link2 = $link2;

        return $this;
    }

    /**
     * Get link2
     *
     * @return string
     */
    public function getLink2()
    {
        return $this->link2;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return CampaignInputDetails
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    /**
     * Get datecreated
     *
     * @return \DateTime
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

    /**
     * Set trafficType
     *
     * @param string $trafficType
     *
     * @return CampaignInputDetails
     */
    public function setTrafficType($trafficType)
    {
        $this->traffic_type = $trafficType;

        return $this;
    }

    /**
     * Get trafficType
     *
     * @return string
     */
    public function getTrafficType()
    {
        return $this->traffic_type;
    }

    /**
     * Set campaigns
     *
     * @param integer $campaigns
     *
     * @return CampaignInputDetails
     */
    public function setCampaigns($campaigns)
    {
        $this->campaigns = $campaigns;

        return $this;
    }

    /**
     * Get campaigns
     *
     * @return integer
     */
    public function getCampaigns()
    {
        return $this->campaigns;
    }

    /**
     * Set emailssent
     *
     * @param integer $emailssent
     *
     * @return CampaignInputDetails
     */
    public function setEmailssent($emailssent)
    {
        $this->emailssent = $emailssent;

        return $this;
    }

    /**
     * Get emailssent
     *
     * @return integer
     */
    public function getEmailssent()
    {
        return $this->emailssent;
    }

    /**
     * Set bounces
     *
     * @param integer $bounces
     *
     * @return CampaignInputDetails
     */
    public function setBounces($bounces)
    {
        $this->bounces = $bounces;

        return $this;
    }

    /**
     * Get bounces
     *
     * @return integer
     */
    public function getBounces()
    {
        return $this->bounces;
    }

    /**
     * Set sbounces
     *
     * @param integer $sbounces
     *
     * @return CampaignInputDetails
     */
    public function setSbounces($sbounces)
    {
        $this->sbounces = $sbounces;

        return $this;
    }

    /**
     * Get sbounces
     *
     * @return integer
     */
    public function getSbounces()
    {
        return $this->sbounces;
    }

    /**
     * Set complaints
     *
     * @param integer $complaints
     *
     * @return CampaignInputDetails
     */
    public function setComplaints($complaints)
    {
        $this->complaints = $complaints;

        return $this;
    }

    /**
     * Get complaints
     *
     * @return integer
     */
    public function getComplaints()
    {
        return $this->complaints;
    }

    /**
     * Set opens
     *
     * @param integer $opens
     *
     * @return CampaignInputDetails
     */
    public function setOpens($opens)
    {
        $this->opens = $opens;

        return $this;
    }

    /**
     * Get opens
     *
     * @return integer
     */
    public function getOpens()
    {
        return $this->opens;
    }

    /**
     * Set clicks
     *
     * @param integer $clicks
     *
     * @return CampaignInputDetails
     */
    public function setClicks($clicks)
    {
        $this->clicks = $clicks;

        return $this;
    }

    /**
     * Get clicks
     *
     * @return integer
     */
    public function getClicks()
    {
        return $this->clicks;
    }

    /**
     * Set spend
     *
     * @param integer $spend
     *
     * @return CampaignInputDetails
     */
    public function setSpend($spend)
    {
        $this->spend = $spend;

        return $this;
    }

    /**
     * Get spend
     *
     * @return integer
     */
    public function getSpend()
    {
        return $this->spend;
    }

    /**
     * Set revenue
     *
     * @param integer $revenue
     *
     * @return CampaignInputDetails
     */
    public function setRevenue($revenue)
    {
        $this->revenue = $revenue;

        return $this;
    }

    /**
     * Get revenue
     *
     * @return integer
     */
    public function getRevenue()
    {
        return $this->revenue;
    }
}
