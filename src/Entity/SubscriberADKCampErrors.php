<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubscriberADKCampErrors
 *
 * @ORM\Table(name="06_subscriberadkcamperrors", uniqueConstraints={@ORM\UniqueConstraint(name="subsc_adk_errors_pkey", columns={"id"})}, indexes={@ORM\Index(name="email_idx", columns={"recipient"})} )
 * @ORM\Entity(repositoryClass="App\Repository\SubscriberADKCampErrorsRepository")
 */
class SubscriberADKCampErrors
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
     * @var int
     *
     * @ORM\Column(name="errornum", type="smallint", nullable=true)
     */
    private $errornum;

    /**
     * @var string
     *
     * @ORM\Column(name="errordesc", type="string", length=255, nullable=true)
     */
    private $errordesc;

    /**
     * @var string
     *
     * @ORM\Column(name="requestid", type="string", length=1000, nullable=true)
     */
    private $requestid;

    /**
     * @var string
     *
     * @ORM\Column(name="recipient", type="string", length=1000, nullable=true)
     */
    private $recipient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datemodified", type="datetime", nullable=true)
     */
    private $datemodified;

    /**
     * Set errornum
     *
     * @param integer $errornum
     *
     * @return SubscriberADKCampErrors
     */
    public function setErrornum($errornum)
    {
        $this->errornum = $errornum;

        return $this;
    }

    /**
     * Get errornum
     *
     * @return int
     */
    public function getErrornum()
    {
        return $this->errornum;
    }

    /**
     * Set errordesc
     *
     * @param string $errordesc
     *
     * @return SubscriberADKCampErrors
     */
    public function setErrordesc($errordesc)
    {
        $this->errordesc = $errordesc;

        return $this;
    }

    /**
     * Get errordesc
     *
     * @return string
     */
    public function getErrordesc()
    {
        return $this->errordesc;
    }

    /**
     * Set requestid
     *
     * @param string $requestid
     *
     * @return SubscriberADKCampErrors
     */
    public function setRequestid($requestid)
    {
        $this->requestid = $requestid;

        return $this;
    }

    /**
     * Get requestid
     *
     * @return string
     */
    public function getRequestid()
    {
        return $this->requestid;
    }

    /**
     * Set recipient
     *
     * @param string $recipient
     *
     * @return SubscriberADKCampErrors
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get recipient
     *
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set datemodified
     *
     * @param \DateTime $datemodified
     *
     * @return SubscriberADKCampErrors
     */
    public function setDatemodified($datemodified)
    {
        $this->datemodified = $datemodified;

        return $this;
    }

    /**
     * Get datemodified
     *
     * @return \DateTime
     */
    public function getDatemodified()
    {
        return $this->datemodified;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return SubscriberADKCampErrors
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

}
