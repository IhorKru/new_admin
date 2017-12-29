<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Campaigns
 *
 * @ORM\Table(name="campaigns")
 * @ORM\Entity(repositoryClass="App\Repository\CampaignsRepository")
 */
class Campaigns
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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="SendyApps", inversedBy="appdetails", cascade={"persist"})
     * @ORM\JoinColumn(name="app", referencedColumnName="id")
     */
    private $app;

    /**
     * @var string
     *
     * @ORM\Column(name="from_name", type="string", length=100, nullable=true)
     */
    private $fromName;

    /**
     * @var string
     *
     * @ORM\Column(name="from_email", type="string", length=100, nullable=true)
     */
    private $fromEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="reply_to", type="string", length=100, nullable=true)
     */
    private $replyTo;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=500, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=500, nullable=true)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="plain_text", type="text", nullable=true)
     */
    private $plainText;

    /**
     * @var string
     *
     * @ORM\Column(name="html_text", type="text", nullable=true)
     */
    private $htmlText;

    /**
     * @var string
     *
     * @ORM\Column(name="query_string", type="string", length=500, nullable=true)
     */
    private $queryString;

    /**
     * @var string
     *
     * @ORM\Column(name="sent", type="string", length=100, nullable=true)
     */
    private $sent = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="to_send", type="integer", nullable=true)
     */
    private $toSend;

    /**
     * @var string
     *
     * @ORM\Column(name="to_send_lists", type="text", length=16777215, nullable=true)
     */
    private $toSendLists;

    /**
     * @var integer
     *
     * @ORM\Column(name="recipients", type="integer", nullable=true)
     */
    private $recipients = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="timeout_check", type="string", length=100, nullable=true)
     */
    private $timeoutCheck;

    /**
     * @var string
     *
     * @ORM\Column(name="opens", type="text", nullable=true)
     */
    private $opens;

    /**
     * @var integer
     *
     * @ORM\Column(name="wysiwyg", type="integer", nullable=true)
     */
    private $wysiwyg = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="send_date", type="string", length=100, nullable=true)
     */
    private $sendDate;

    /**
     * @var string
     *
     * @ORM\Column(name="lists", type="text", length=16777215, nullable=true)
     */
    private $lists;

    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=100, nullable=true)
     */
    private $timezone;

    /**
     * @var string
     *
     * @ORM\Column(name="errors", type="text", nullable=true)
     */
    private $errors;

    /**
     * @var integer
     *
     * @ORM\Column(name="bounce_setup", type="integer", nullable=true)
     */
    private $bounceSetup = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="complaint_setup", type="integer", nullable=true)
     */
    private $complaintSetup = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="opens_tracking", type="integer", nullable=true)
     */
    private $openstacking = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="links_tracking", type="integer", nullable=true)
     */
    private $linkstracking = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="batch_id", type="integer", nullable=true)
     */
    private $batch_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=true)
     */
    private $category_id;

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
     * @return Campaigns
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
     * @return Campaigns
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
     * Set fromName
     *
     * @param string $fromName
     *
     * @return Campaigns
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * Get fromName
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * Set fromEmail
     *
     * @param string $fromEmail
     *
     * @return Campaigns
     */
    public function setFromEmail($fromEmail)
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    /**
     * Get fromEmail
     *
     * @return string
     */
    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    /**
     * Set replyTo
     *
     * @param string $replyTo
     *
     * @return Campaigns
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * Get replyTo
     *
     * @return string
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Campaigns
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Campaigns
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set plainText
     *
     * @param string $plainText
     *
     * @return Campaigns
     */
    public function setPlainText($plainText)
    {
        $this->plainText = $plainText;

        return $this;
    }

    /**
     * Get plainText
     *
     * @return string
     */
    public function getPlainText()
    {
        return $this->plainText;
    }

    /**
     * Set htmlText
     *
     * @param string $htmlText
     *
     * @return Campaigns
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
     * Set queryString
     *
     * @param string $queryString
     *
     * @return Campaigns
     */
    public function setQueryString($queryString)
    {
        $this->queryString = $queryString;

        return $this;
    }

    /**
     * Get queryString
     *
     * @return string
     */
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * Set sent
     *
     * @param string $sent
     *
     * @return Campaigns
     */
    public function setSent($sent)
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * Get sent
     *
     * @return string
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * Set toSend
     *
     * @param integer $toSend
     *
     * @return Campaigns
     */
    public function setToSend($toSend)
    {
        $this->toSend = $toSend;

        return $this;
    }

    /**
     * Get toSend
     *
     * @return integer
     */
    public function getToSend()
    {
        return $this->toSend;
    }

    /**
     * Set toSendLists
     *
     * @param string $toSendLists
     *
     * @return Campaigns
     */
    public function setToSendLists($toSendLists)
    {
        $this->toSendLists = $toSendLists;

        return $this;
    }

    /**
     * Get toSendLists
     *
     * @return string
     */
    public function getToSendLists()
    {
        return $this->toSendLists;
    }

    /**
     * Set recipients
     *
     * @param integer $recipients
     *
     * @return Campaigns
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;

        return $this;
    }

    /**
     * Get recipients
     *
     * @return integer
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Set timeoutCheck
     *
     * @param string $timeoutCheck
     *
     * @return Campaigns
     */
    public function setTimeoutCheck($timeoutCheck)
    {
        $this->timeoutCheck = $timeoutCheck;

        return $this;
    }

    /**
     * Get timeoutCheck
     *
     * @return string
     */
    public function getTimeoutCheck()
    {
        return $this->timeoutCheck;
    }

    /**
     * Set opens
     *
     * @param string $opens
     *
     * @return Campaigns
     */
    public function setOpens($opens)
    {
        $this->opens = $opens;

        return $this;
    }

    /**
     * Get opens
     *
     * @return string
     */
    public function getOpens()
    {
        return $this->opens;
    }

    /**
     * Set wysiwyg
     *
     * @param integer $wysiwyg
     *
     * @return Campaigns
     */
    public function setWysiwyg($wysiwyg)
    {
        $this->wysiwyg = $wysiwyg;

        return $this;
    }

    /**
     * Get wysiwyg
     *
     * @return integer
     */
    public function getWysiwyg()
    {
        return $this->wysiwyg;
    }

    /**
     * Set sendDate
     *
     * @param string $sendDate
     *
     * @return Campaigns
     */
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;

        return $this;
    }

    /**
     * Get sendDate
     *
     * @return string
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * Set lists
     *
     * @param string $lists
     *
     * @return Campaigns
     */
    public function setLists($lists)
    {
        $this->lists = $lists;

        return $this;
    }

    /**
     * Get lists
     *
     * @return string
     */
    public function getLists()
    {
        return $this->lists;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     *
     * @return Campaigns
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set errors
     *
     * @param string $errors
     *
     * @return Campaigns
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * Get errors
     *
     * @return string
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set bounceSetup
     *
     * @param integer $bounceSetup
     *
     * @return Campaigns
     */
    public function setBounceSetup($bounceSetup)
    {
        $this->bounceSetup = $bounceSetup;

        return $this;
    }

    /**
     * Get bounceSetup
     *
     * @return integer
     */
    public function getBounceSetup()
    {
        return $this->bounceSetup;
    }

    /**
     * Set complaintSetup
     *
     * @param integer $complaintSetup
     *
     * @return Campaigns
     */
    public function setComplaintSetup($complaintSetup)
    {
        $this->complaintSetup = $complaintSetup;

        return $this;
    }

    /**
     * Get complaintSetup
     *
     * @return integer
     */
    public function getComplaintSetup()
    {
        return $this->complaintSetup;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Campaigns
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set openstacking
     *
     * @param integer $openstacking
     *
     * @return Campaigns
     */
    public function setOpenstacking($openstacking)
    {
        $this->openstacking = $openstacking;

        return $this;
    }

    /**
     * Get openstacking
     *
     * @return integer
     */
    public function getOpenstacking()
    {
        return $this->openstacking;
    }

    /**
     * Set linkstracking
     *
     * @param integer $linkstracking
     *
     * @return Campaigns
     */
    public function setLinkstracking($linkstracking)
    {
        $this->linkstracking = $linkstracking;

        return $this;
    }

    /**
     * Get linkstracking
     *
     * @return integer
     */
    public function getLinkstracking()
    {
        return $this->linkstracking;
    }

    /**
     * Set batchId
     *
     * @param integer $batchId
     *
     * @return Campaigns
     */
    public function setBatchId($batchId)
    {
        $this->batch_id = $batchId;

        return $this;
    }

    /**
     * Get batchId
     *
     * @return integer
     */
    public function getBatchId()
    {
        return $this->batch_id;
    }


    /**
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return Campaigns
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }
}
