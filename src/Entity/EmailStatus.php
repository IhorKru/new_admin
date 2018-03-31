<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="emailstatus", uniqueConstraints={@ORM\UniqueConstraint(name="email_status_pkey", columns={"id"})}, indexes={@ORM\Index(name="email_status_idx", columns={"userID"})} )
 * @ORM\Entity(repositoryClass="App\Repository\EmailStatusRepository")
 */
class EmailStatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="userID", type="integer")
     */
    private $userid;

    /**
     * @var string
     * @ORM\Column(name="rfccheck", type="string", length=100)
     */
    private $rfccheck;

    /**
     * @var string
     * @ORM\Column(name="dnscheck", type="string", length=100)
     */
    private $dnscheck;

    /**
     * @var string
     * @ORM\Column(name="spoofcheck", type="string", length=100)
     */
    private $spoofcheck;

    /**
     * @var string
     * @ORM\Column(name="smtpcheck", type="string", length=100)
    */
    private $smtpcheck;

    /**
     * @var string
     * @ORM\Column(name="nbstatus", type="integer")
     */
    private $nbstatus;

    /**
     * @var int
     *
     * @ORM\Column(name="datecreated", type="datetime", length=255)
     */
    private $datecreated;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserid(): int
    {
        return $this->userid;
    }

    /**
     * @param int $userid
     */
    public function setUserid(int $userid): void
    {
        $this->userid = $userid;
    }

    /**
     * @return string
     */
    public function getRfccheck(): string
    {
        return $this->rfccheck;
    }

    /**
     * @param string $rfccheck
     */
    public function setRfccheck(string $rfccheck): void
    {
        $this->rfccheck = $rfccheck;
    }

    /**
     * @return string
     */
    public function getDnscheck(): string
    {
        return $this->dnscheck;
    }

    /**
     * @param string $dnscheck
     */
    public function setDnscheck(string $dnscheck): void
    {
        $this->dnscheck = $dnscheck;
    }

    /**
     * @return string
     */
    public function getSpoofcheck(): string
    {
        return $this->spoofcheck;
    }

    /**
     * @param string $spoofcheck
     */
    public function setSpoofcheck(string $spoofcheck): void
    {
        $this->spoofcheck = $spoofcheck;
    }

    /**
     * @return string
     */
    public function getSmtpcheck(): string
    {
        return $this->smtpcheck;
    }

    /**
     * @param string $smtpcheck
     */
    public function setSmtpcheck(string $smtpcheck): void
    {
        $this->smtpcheck = $smtpcheck;
    }

    /**
     * @return int
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

    /**
     * @param int $datecreated
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;
    }

    /**
     * @return string
     */
    public function getNbstatus(): string
    {
        return $this->nbstatus;
    }

    /**
     * @param string $nbstatus
     */
    public function setNbstatus(string $nbstatus): void
    {
        $this->nbstatus = $nbstatus;
    }

}
