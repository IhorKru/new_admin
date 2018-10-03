<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Links
 *
 * @ORM\Table(name="links", uniqueConstraints={@ORM\UniqueConstraint(name="links_pkey", columns={"id"})} )
 * @ORM\Entity(repositoryClass="App\Repository\LinksRepository")
 */
class Links
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
     * @var int
     *
     * @ORM\Column(name="campaign_id", type="integer")
     */
    private $campaignId;

    /**
     * @var int
     *
     * @ORM\Column(name="areas_email_id", type="integer")
     */
    private $areasEmailId;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=1200)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="clicks", type="string", length=1200, nullable=true)
     */
    private $clicks;


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
     * Set areasEmailId
     *
     * @param integer $areasEmailId
     *
     * @return Links
     */
    public function setAreasEmailId($areasEmailId)
    {
        $this->areasEmailId = $areasEmailId;

        return $this;
    }

    /**
     * Get areasEmailId
     *
     * @return int
     */
    public function getAreasEmailId()
    {
        return $this->areasEmailId;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Links
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set clicks
     *
     * @param string $clicks
     *
     * @return Links
     */
    public function setClicks($clicks)
    {
        $this->clicks = $clicks;

        return $this;
    }

    /**
     * Get clicks
     *
     * @return string
     */
    public function getClicks()
    {
        return $this->clicks;
    }


    /**
     * Set campaignId
     *
     * @param integer $campaignId
     *
     * @return Links
     */
    public function setCampaignId($campaignId)
    {
        $this->campaignId = $campaignId;

        return $this;
    }

    /**
     * Get campaignId
     *
     * @return integer
     */
    public function getCampaignId()
    {
        return $this->campaignId;
    }
}
