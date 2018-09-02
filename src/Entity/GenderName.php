<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="ref_name_gender", uniqueConstraints={@ORM\UniqueConstraint(name="gender_name_pkey", columns={"id"})}, indexes={@ORM\Index(name="email_status_idx", columns={"id"})} )
 * @ORM\Entity(repositoryClass="App\Repository\EmailStatusRepository")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getFirstnameSanitized(): ?string
    {
        return $this->firstname_sanitized;
    }

    public function setFirstnameSanitized(string $firstname_sanitized): self
    {
        $this->firstname_sanitized = $firstname_sanitized;

        return $this;
    }

    public function getGenderid(): ?int
    {
        return $this->genderid;
    }

    public function setGenderid(int $genderid): self
    {
        $this->genderid = $genderid;

        return $this;
    }

    public function getSamples(): ?int
    {
        return $this->samples;
    }

    public function setSamples(int $samples): self
    {
        $this->samples = $samples;

        return $this;
    }

    public function getAccuracy(): ?int
    {
        return $this->accuracy;
    }

    public function setAccuracy(int $accuracy): self
    {
        $this->accuracy = $accuracy;

        return $this;
    }

    public function getDatecreated(): ?\DateTimeInterface
    {
        return $this->datecreated;
    }

    public function setDatecreated(\DateTimeInterface $datecreated): self
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    public function getDatemodified(): ?\DateTimeInterface
    {
        return $this->datemodified;
    }

    public function setDatemodified(\DateTimeInterface $datemodified): self
    {
        $this->datemodified = $datemodified;

        return $this;
    }

}
