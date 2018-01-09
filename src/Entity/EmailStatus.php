<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="01.1_emailstatus", uniqueConstraints={@ORM\UniqueConstraint(name="email_status_pkey", columns={"id"})}, indexes={@ORM\Index(name="email_status_idx", columns={"emailaddress"})} )
 * @ORM\Entity(repositoryClass="App\Repository\EmailStatusRepository")
 */
class EmailStatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank (message="Complete Email Address field")
     * @ORM\Column(name="emailaddress", type="string", length=100)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true,
     *     checkHost = true
     * )
     */
    private $emailaddress;

    /**
     * @var string
     * @ORM\Column(name="emailstatus", type="string", length=100)
     */
    private $emailstatus;

    /**
     * @var int
     *
     * @ORM\Column(name="datecreated", type="datetime", nullable=false)
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
     * @return string
     */
    public function getEmailaddress(): string
    {
        return $this->emailaddress;
    }

    /**
     * @param string $emailaddress
     */
    public function setEmailaddress(string $emailaddress): void
    {
        $this->emailaddress = $emailaddress;
    }

    /**
     * @return string
     */
    public function getEmailstatus(): string
    {
        return $this->emailstatus;
    }

    /**
     * @param string $emailstatus
     */
    public function setEmailstatus(string $emailstatus): void
    {
        $this->emailstatus = $emailstatus;
    }

    /**
     * @return int
     */
    public function getDatecreated(): int
    {
        return $this->datecreated;
    }

    /**
     * @param int $datecreated
     */
    public function setDatecreated(int $datecreated): void
    {
        $this->datecreated = $datecreated;
    }

}
