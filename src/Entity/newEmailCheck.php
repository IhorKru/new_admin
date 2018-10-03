<?php
/**
 * Created by PhpStorm.
 * User: IKRUCHYNENKO
 * Date: 24-Jan-18
 * Time: 03:29 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="emailcheckrequests", uniqueConstraints={@ORM\UniqueConstraint(name="email_check_pkey", columns={"id"})})} )
 * @ORM\Entity(repositoryClass="App\Repository\EmailStatusRepository")
 */
class newEmailCheck
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="numemails", type="integer")
     */
    private $numemails;

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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getNumemails()
    {
        return $this->numemails;
    }

    /**
     * @param int $numemails
     */
    public function setNumemails(int $numemails)
    {
        $this->numemails = $numemails;
    }



}