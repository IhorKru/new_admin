<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RefTireDetails
 *
 * @ORM\Table(name="ref_tire_details", uniqueConstraints={@ORM\UniqueConstraint(name="ref_tire_pkey", columns={"id"})})
 * @ORM\Entity(repositoryClass="App\Repository\RefTireDetailsRepository")
 */
class RefTireDetails
{

    /**
     *@ORM\OneToMany(targetEntity="PartnerDetails", mappedBy="tire", cascade={"persist"})
     */
    private $partnertire;

    public function __construct()
    {
        $this->partnertire = new ArrayCollection();

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
     * @ORM\Column(name="tire_name", type="string", length=255)
     */
    private $tireName;

    /**
     * @var string
     *
     * @ORM\Column(name="tire_desc", type="string", length=255)
     */
    private $tireDesc;

    /**
     * @var int
     *
     * @ORM\Column(name="partner_type", type="integer")
     */
    private $partnerType;

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
     * Set tireName
     *
     * @param string $tireName
     *
     * @return RefTireDetails
     */
    public function setTireName($tireName)
    {
        $this->tireName = $tireName;

        return $this;
    }

    /**
     * Get tireName
     *
     * @return string
     */
    public function getTireName()
    {
        return $this->tireName;
    }

    /**
     * Set tireDesc
     *
     * @param string $tireDesc
     *
     * @return RefTireDetails
     */
    public function setTireDesc($tireDesc)
    {
        $this->tireDesc = $tireDesc;

        return $this;
    }

    /**
     * Get tireDesc
     *
     * @return string
     */
    public function getTireDesc()
    {
        return $this->tireDesc;
    }

    /**
     * Set partnerType
     *
     * @param integer $partnerType
     *
     * @return RefTireDetails
     */
    public function setPartnerType($partnerType)
    {
        $this->partnerType = $partnerType;

        return $this;
    }

    /**
     * Get partnerType
     *
     * @return int
     */
    public function getPartnerType()
    {
        return $this->partnerType;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified
     *
     * @return RefTireDetails
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
     * Add partnertire
     *
     * @param \App\Entity\PartnerDetails $partnertire
     *
     * @return RefTireDetails
     */
    public function addPartnertire(\App\Entity\PartnerDetails $partnertire)
    {
        $this->partnertire[] = $partnertire;

        return $this;
    }

    /**
     * Remove partnertire
     *
     * @param \App\Entity\PartnerDetails $partnertire
     */
    public function removePartnertire(\App\Entity\PartnerDetails $partnertire)
    {
        $this->partnertire->removeElement($partnertire);
    }

    /**
     * Get partnertire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartnertire()
    {
        return $this->partnertire;
    }
}
