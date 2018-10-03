<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="ref_name_gender", uniqueConstraints={@ORM\UniqueConstraint(name="gender_name_pkey", columns={"id"})}, indexes={@ORM\Index(name="email_status_idx", columns={"id"})} )
 * @ORM\Entity(repositoryClass="App\Repository\GenderNameRepository")
 */
class GenderName
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="firstname", type="string", length=100)
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column(name="firstname_sanitized", type="string", length=100)
     */
    private $firstname_sanitized;

    /**
     * @var string
     * @ORM\Column(name="gender_id", type="integer")
     */
    private $gender_id;

    /**
     * @var string
     * @ORM\Column(name="samples", type="integer")
     */
    private $samples;

    /**
     * @var string
     * @ORM\Column(name="accuracy", type="integer")
     */
    private $accuracy;

    /**
     * @var int
     *
     * @ORM\Column(name="datecreated", type="datetime", length=255)
     */
    private $datecreated;

    /**
     * @var int
     *
     * @ORM\Column(name="datemodified", type="datetime", length=255)
     */
    private $datemodified;

    /**
     * @var string
     * @ORM\Column(name="vendor", type="string", length=100)
     */
    private $vendor;

    public function getId()
    {
        return $this->id;
    }
    
    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getFirstnameSanitized()
    {
        return $this->firstname_sanitized;
    }

    public function setFirstnameSanitized(string $firstname_sanitized)
    {
        $this->firstname_sanitized = $firstname_sanitized;

        return $this;
    }

    public function getGenderId()
    {
        return $this->gender_id;
    }

    public function setGenderId($gender_id)
    {
        $this->gender_id = $gender_id;

        return $this;
    }

    public function getSamples()
    {
        return $this->samples;
    }

    public function setSamples(int $samples)
    {
        $this->samples = $samples;

        return $this;
    }

    public function getAccuracy()
    {
        return $this->accuracy;
    }

    public function setAccuracy(int $accuracy)
    {
        $this->accuracy = $accuracy;

        return $this;
    }

    public function getDatecreated()
    {
        return $this->datecreated;
    }

    public function setDatecreated(\DateTimeInterface $datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    public function getDatemodified()
    {
        return $this->datemodified;
    }

    public function setDatemodified(\DateTimeInterface $datemodified)
    {
        $this->datemodified = $datemodified;

        return $this;
    }

    public function getVendor()
    {
        return $this->vendor;
    }

    public function setVendor(string $vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }

}
