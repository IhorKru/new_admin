<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PartnerDetails
 *
 * @ORM\Table(name="p_01_partner_details", uniqueConstraints={@ORM\UniqueConstraint(name="partner_pkey", columns={"id"})} )
 * @ORM\Entity(repositoryClass="App\Repository\PartnerDetailsRepository")
 */
class PartnerDetails
{

    /**
     *@ORM\OneToMany(targetEntity="newAdOfferDetails", mappedBy="partner", cascade={"persist"})
     */
    private $offerdetails;

    public function __construct()
    {
        $this->offerdetails = new ArrayCollection();

    }

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
     * @ORM\Column(name="partner_name", type="string", length=255)
     */
    private $partner_name;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="RefWebTrafficTypeDetails", inversedBy="partnertraffic", cascade={"persist"})
     */
    private $trafficType;

    /**
     * @var string
     *
     * @ORM\Column(name="geo", type="string", length=255)
     */
    private $geo;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="RefPartnerTypeDetails", inversedBy="partnerdetails", cascade={"persist"})
     */
    private $partnerType;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=255)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="RefTireDetails", inversedBy="partnertire", cascade={"persist"})
     */
    private $tire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $date_created;


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
     * Set partnerName
     *
     * @param string $partnerName
     *
     * @return PartnerDetails
     */
    public function setPartnerName($partnerName)
    {
        $this->partner_name = $partnerName;

        return $this;
    }

    /**
     * Get partnerName
     *
     * @return string
     */
    public function getPartnerName()
    {
        return $this->partner_name;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return PartnerDetails
     */
    public function setDateCreated($dateCreated)
    {
        $this->date_created = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Set geo
     *
     * @param string $geo
     *
     * @return PartnerDetails
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
     * Set size
     *
     * @param string $size
     *
     * @return PartnerDetails
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set partnerType
     *
     * @param \App\Entity\RefPartnerTypeDetails $id
     *
     * @return PartnerDetails
     */
    public function setPartnerType(\App\Entity\RefPartnerTypeDetails $id = null)
    {
        $this->partnerType = $id;

        return $this;
    }

    /**
     * Get partnerType
     *
     * @return \App\Entity\RefPartnerTypeDetails
     */
    public function getPartnerType()
    {
        return $this->partnerType;
    }


    /**
     * Set trafficType
     *
     * @param \App\Entity\RefWebTrafficTypeDetails $id
     *
     * @return PartnerDetails
     */
    public function setTrafficType(\App\Entity\RefWebTrafficTypeDetails $id = null)
    {
        $this->trafficType = $id;

        return $this;
    }

    /**
     * Get trafficType
     *
     * @return \App\Entity\RefWebTrafficTypeDetails
     */
    public function getTrafficType()
    {
        return $this->trafficType;
    }

    /**
     * Set tire
     *
     * @param \App\Entity\RefTireDetails $id
     *
     * @return PartnerDetails
     */
    public function setTire(\App\Entity\RefTireDetails $id = null)
    {
        $this->tire = $id;

        return $this;
    }

    /**
     * Get tire
     *
     * @return \App\Entity\RefTireDetails
     */
    public function getTire()
    {
        return $this->tire;
    }

    /**
     * Add offerdetail
     *
     * @param \App\Entity\newAdOfferDetails $offerdetail
     *
     * @return PartnerDetails
     */
    public function addOfferdetail(\App\Entity\newAdOfferDetails $offerdetail)
    {
        $this->offerdetails[] = $offerdetail;

        return $this;
    }

    /**
     * Remove offerdetail
     *
     * @param \App\Entity\newAdOfferDetails $offerdetail
     */
    public function removeOfferdetail(\App\Entity\newAdOfferDetails $offerdetail)
    {
        $this->offerdetails->removeElement($offerdetail);
    }

    /**
     * Get offerdetails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOfferdetails()
    {
        return $this->offerdetails;
    }
}
