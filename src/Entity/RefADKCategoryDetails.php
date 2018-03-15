<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RefADKCategoryDetails
 *
 * @ORM\Table(name="ref_adk_category_details", uniqueConstraints={@ORM\UniqueConstraint(name="ref_adk_category_pkey", columns={"id"})} )
 * @ORM\Entity(repositoryClass="App\Repository\RefADKCategoryDetailsRepository")
 */
class RefADKCategoryDetails
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
     * @ORM\Column(name="categoryid", type="smallint", nullable=true)
     */
    private $categoryid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="SendyApps", inversedBy="refadkcategory", cascade={"persist"})
     * @ORM\JoinColumn(name="app_id", referencedColumnName="id")
     *
     */
    private $appId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime", nullable=true)
     */
    private $datecreated;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return RefADKCategoryDetails
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
     * Set categoryid
     *
     * @param integer $categoryid
     *
     * @return RefADKCategoryDetails
     */
    public function setCategoryid($categoryid)
    {
        $this->categoryid = $categoryid;

        return $this;
    }

    /**
     * Get categoryid
     *
     * @return integer
     */
    public function getCategoryid()
    {
        return $this->categoryid;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return RefADKCategoryDetails
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
     * Set appId
     *
     * @param integer $appId
     *
     * @return RefADKCategoryDetails
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;

        return $this;
    }

    /**
     * Get appId
     *
     * @return integer
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return RefADKCategoryDetails
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
}
