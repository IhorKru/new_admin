<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * newAdOfferDetails
 *
 * @ORM\Table(name="ad_01_offer_details", uniqueConstraints={@ORM\UniqueConstraint(name="ad_offer_details_pkey", columns={"id"})})
 * @ORM\Entity(repositoryClass="App\Repository\newAdOfferDetailsRepository")
 */
class newAdOfferDetails
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
     * @ORM\Column(name="offer_name", type="string", length=255)
     */
    private $offerName;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="PartnerDetails", inversedBy="offerdetails", cascade={"persist"})
     */
    private $partner;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="geo", type="string", length=255)
     */
    private $geo;

    /**
     * @var string
     *
     * @ORM\Column(name="offer_desc", type="string", length=1000)
     */
    private $offerDesc;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="RefOfferStatusDetails", inversedBy="offerdetails", cascade={"persist"})
     */
    private $offerStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modified", type="datetime")
     */
    private $dateModified;


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
     * Set offerName
     *
     * @param string $offerName
     *
     * @return newAdOfferDetails
     */
    public function setOfferName($offerName)
    {
        $this->offerName = $offerName;

        return $this;
    }

    /**
     * Get offerName
     *
     * @return string
     */
    public function getOfferName()
    {
        return $this->offerName;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return newAdOfferDetails
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set geo
     *
     * @param string $geo
     *
     * @return newAdOfferDetails
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
     * Set offerDesc
     *
     * @param string $offerDesc
     *
     * @return newAdOfferDetails
     */
    public function setOfferDesc($offerDesc)
    {
        $this->offerDesc = $offerDesc;

        return $this;
    }

    /**
     * Get offerDesc
     *
     * @return string
     */
    public function getOfferDesc()
    {
        return $this->offerDesc;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified
     *
     * @return newAdOfferDetails
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set partner
     *
     * @param \App\Entity\PartnerDetails $id
     *
     * @return newAdOfferDetails
     */
    public function setPartner(\App\Entity\PartnerDetails $id = null)
    {
        $this->partner = $id;

        return $this;
    }

    /**
     * Get partner
     *
     * @return \App\Entity\PartnerDetails
     */
    public function getPartner()
    {
        return $this->partner;
    }


    /**
     * Set offerStatus
     *
     * @param \App\Entity\RefOfferStatusDetails $id
     *
     * @return newAdOfferDetails
     */
    public function setOfferStatus(\App\Entity\RefOfferStatusDetails $id = null)
    {
        $this->offerStatus = $id;

        return $this;
    }

    /**
     * Get offerStatus
     *
     * @return \App\Entity\RefOfferStatusDetails
     */
    public function getOfferStatus()
    {
        return $this->offerStatus;
    }
}
