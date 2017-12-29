<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Template
 *
 * @ORM\Table(name="template")
 * @ORM\Entity(repositoryClass="App\Repository\TemplateRepository")
 */
class Template
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, unique=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     * 
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="userID", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var int
     *
     * @ORM\Column(name="app", type="integer", nullable=true)
     */
    private $app;

    /**
     * @var string
     *
     * @ORM\Column(name="template_name", type="string", length=100, nullable=true)
     */
    private $templateName;

    /**
     * @var string
     *
     * @ORM\Column(name="html_text", type="text", nullable=true)
     */
    private $htmlText;

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
     * Set userid
     *
     * @param integer $userid
     *
     * @return Template
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set app
     *
     * @param integer $app
     *
     * @return Template
     */
    public function setApp($app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Get app
     *
     * @return integer
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Set templateName
     *
     * @param string $templateName
     *
     * @return Template
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;

        return $this;
    }

    /**
     * Get templateName
     *
     * @return string
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

    /**
     * Set htmlText
     *
     * @param string $htmlText
     *
     * @return Template
     */
    public function setHtmlText($htmlText)
    {
        $this->htmlText = $htmlText;

        return $this;
    }

    /**
     * Get htmlText
     *
     * @return string
     */
    public function getHtmlText()
    {
        return $this->htmlText;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Template
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
