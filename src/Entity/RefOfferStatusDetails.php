<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RefOfferStatusDetails
 *
 * @ORM\Table(name="ref_offer_status_details", uniqueConstraints={@ORM\UniqueConstraint(name="ref_offer_status_pkey", columns={"id"})})
 * @ORM\Entity(repositoryClass="App\Repository\RefOfferStatusDetailsRepository")
 */
class RefOfferStatusDetails
{

    /**
     *@ORM\OneToMany(targetEntity="newAdOfferDetails", mappedBy="offerStatus", cascade={"persist"})
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
     * @ORM\Column(name="status_name", type="string", length=255)
     */
    private $statusName;

    /**
     * @var string
     *
     * @ORM\Column(name="status_desc", type="string", length=255)
     */
    private $statusDesc;

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
     * Set statusName
     *
     * @param string $statusName
     *
     * @return RefOfferStatusDetails
     */
    public function setStatusName($statusName)
    {
        $this->statusName = $statusName;

        return $this;
    }

    /**
     * Get statusName
     *
     * @return string
     */
    public function getStatusName()
    {
        return $this->statusName;
    }

    /**
     * Set statusDesc
     *
     * @param string $statusDesc
     *
     * @return RefOfferStatusDetails
     */
    public function setStatusDesc($statusDesc)
    {
        $this->statusDesc = $statusDesc;

        return $this;
    }

    /**
     * Get statusDesc
     *
     * @return string
     */
    public function getStatusDesc()
    {
        return $this->statusDesc;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified
     *
     * @return RefOfferStatusDetails
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
     * Add offerdetail
     *
     * @param \App\Entity\newAdOfferDetails $offerdetail
     *
     * @return RefOfferStatusDetails
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
