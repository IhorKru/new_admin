<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RefWebTrafficTypeDetails
 *
 * @ORM\Table(name="ref_web_traffic_type_details", uniqueConstraints={@ORM\UniqueConstraint(name="ref_traffic_type_pkey", columns={"id"})})
 * @ORM\Entity(repositoryClass="App\Repository\RefWebTrafficTypeDetailsRepository")
 */
class RefWebTrafficTypeDetails
{

    /**
     *@ORM\OneToMany(targetEntity="PartnerDetails", mappedBy="trafficType", cascade={"persist"})
     */
    private $partnertraffic;

    public function __construct()
    {
        $this->partnertraffic = new ArrayCollection();

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
     * @ORM\Column(name="traffic_type_name", type="string", length=255)
     */
    private $trafficTypeName;

    /**
     * @var string
     *
     * @ORM\Column(name="traffic_type_desc", type="string", length=255)
     */
    private $trafficTypeDesc;


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
     * Set trafficTypeName
     *
     * @param string $trafficTypeName
     *
     * @return RefWebTrafficTypeDetails
     */
    public function setTrafficTypeName($trafficTypeName)
    {
        $this->trafficTypeName = $trafficTypeName;

        return $this;
    }

    /**
     * Get trafficTypeName
     *
     * @return string
     */
    public function getTrafficTypeName()
    {
        return $this->trafficTypeName;
    }

    /**
     * Set trafficTypeDesc
     *
     * @param string $trafficTypeDesc
     *
     * @return RefWebTrafficTypeDetails
     */
    public function setTrafficTypeDesc($trafficTypeDesc)
    {
        $this->trafficTypeDesc = $trafficTypeDesc;

        return $this;
    }

    /**
     * Get trafficTypeDesc
     *
     * @return string
     */
    public function getTrafficTypeDesc()
    {
        return $this->trafficTypeDesc;
    }


    /**
     * Add partnertraffic
     *
     * @param \App\Entity\PartnerDetails $partnertraffic
     *
     * @return RefWebTrafficTypeDetails
     */
    public function addPartnertraffic(\App\Entity\PartnerDetails $partnertraffic)
    {
        $this->partnertraffic[] = $partnertraffic;

        return $this;
    }

    /**
     * Remove partnertraffic
     *
     * @param \App\Entity\PartnerDetails $partnertraffic
     */
    public function removePartnertraffic(\App\Entity\PartnerDetails $partnertraffic)
    {
        $this->partnertraffic->removeElement($partnertraffic);
    }

    /**
     * Get partnertraffic
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartnertraffic()
    {
        return $this->partnertraffic;
    }
}
