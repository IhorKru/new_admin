<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RefPartnerTypeDetails
 *
 * @ORM\Table(name="ref_partner_type_details", uniqueConstraints={@ORM\UniqueConstraint(name="ref_partner_type_pkey", columns={"id"})})
 * @ORM\Entity(repositoryClass="App\Repository\PartnerTypeDetailsRepository")
 */
class RefPartnerTypeDetails
{

    /**
     *@ORM\OneToMany(targetEntity="PartnerDetails", mappedBy="partnerType", cascade={"persist"})
     */
    private $partnerdetails;

    public function __construct()
    {
        $this->partnerdetails = new ArrayCollection();

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
     * @ORM\Column(name="partner_type_name", type="string", length=255)
     */
    private $partnerTypeName;


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
     * Set partnerTypeName
     *
     * @param string $partnerTypeName
     *
     * @return RefPartnerTypeDetails
     */
    public function setPartnerTypeName($partnerTypeName)
    {
        $this->partnerTypeName = $partnerTypeName;

        return $this;
    }

    /**
     * Get partnerTypeName
     *
     * @return string
     */
    public function getPartnerTypeName()
    {
        return $this->partnerTypeName;
    }

    /**
     * Add partnerdetail
     *
     * @param \App\Entity\PartnerDetails $partnerdetail
     *
     * @return RefPartnerTypeDetails
     */
    public function addPartnerdetail(\App\Entity\PartnerDetails $partnerdetail)
    {
        $this->partnerdetails[] = $partnerdetail;

        return $this;
    }

    /**
     * Remove partnerdetail
     *
     * @param \App\Entity\PartnerDetails $partnerdetail
     */
    public function removePartnerdetail(\App\Entity\PartnerDetails $partnerdetail)
    {
        $this->partnerdetails->removeElement($partnerdetail);
    }

    /**
     * Get partnerdetails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartnerdetails()
    {
        return $this->partnerdetails;
    }
}
