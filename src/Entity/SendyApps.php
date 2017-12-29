<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * SendyApps
 *
 * @ORM\Table(name="apps", uniqueConstraints={@ORM\UniqueConstraint(name="sendy_apps_pkey", columns={"id"})})
 * @ORM\Entity(repositoryClass="App\Repository\SendyAppsRepository")
 */
class SendyApps
{

    /**
     *@ORM\OneToMany(targetEntity="Campaigns", mappedBy="app", cascade={"persist"})
     */
    private $appdetails;

    /**
     *@ORM\OneToMany(targetEntity="Lists", mappedBy="app", cascade={"persist"})
     */
    private $listdetails;

    /**
     *@ORM\OneToMany(targetEntity="RefADKCategoryDetails", mappedBy="appId", cascade={"persist"})
     */
    private $refadkcategory;

    public function __construct()
    {
        $this->appdetails = new ArrayCollection();
        $this->listdetails = new ArrayCollection();
        $this->refadkcategory = new ArrayCollection();
    }

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
     * @ORM\Column(name="userID", type="integer")
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="app_name", type="string", length=100)
     */
    private $appName;

    /**
     * @var string
     *
     * @ORM\Column(name="from_name", type="string", length=100)
     */
    private $fromName;

    /**
     * @var string
     *
     * @ORM\Column(name="from_email", type="string", length=100)
     */
    private $fromEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="reply_to", type="string", length=100)
     */
    private $replyTo;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=100)
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="delivery_fee", type="string", length=100)
     */
    private $deliveryFee;

    /**
     * @var string
     *
     * @ORM\Column(name="cost_per_recipient", type="string", length=100)
     */
    private $costPerRecipient;

    /**
     * @var string
     *
     * @ORM\Column(name="smtp_host", type="string", length=100)
     */
    private $smtpHost;

    /**
     * @var string
     *
     * @ORM\Column(name="smtp_port", type="string", length=100)
     */
    private $smtpPort;

    /**
     * @var string
     *
     * @ORM\Column(name="smtp_ssl", type="string", length=100)
     */
    private $smtpSsl;

    /**
     * @var string
     *
     * @ORM\Column(name="smtp_username", type="string", length=100)
     */
    private $smtpUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="smtp_password", type="string", length=100)
     */
    private $smtpPassword;

    /**
     * @var int
     *
     * @ORM\Column(name="bounce_setup", type="integer")
     */
    private $bounceSetup;

    /**
     * @var int
     *
     * @ORM\Column(name="complaint_setup", type="integer")
     */
    private $complaintSetup;

    /**
     * @var string
     *
     * @ORM\Column(name="app_key", type="string", length=100)
     */
    private $appKey;

    /**
     * @var int
     *
     * @ORM\Column(name="allocated_quota", type="integer")
     */
    private $allocatedQuota;

    /**
     * @var int
     *
     * @ORM\Column(name="current_quota", type="integer")
     */
    private $currentQuota;

    /**
     * @var int
     *
     * @ORM\Column(name="day_of_reset", type="integer")
     */
    private $dayOfReset;

    /**
     * @var string
     *
     * @ORM\Column(name="month_of_next_reset", type="string", length=3)
     */
    private $monthOfNextReset;

    /**
     * @var string
     *
     * @ORM\Column(name="test_email", type="string", length=100)
     */
    private $testEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="brand_logo_filename", type="string", length=100)
     */
    private $brandLogoFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="allowed_attachments", type="string", length=100)
     */
    private $allowedAttachments;

    /**
     * @var int
     *
     * @ORM\Column(name="reports_only", type="integer")
     */
    private $reportsOnly;

    /**
     * @var string
     *
     * @ORM\Column(name="subscribe_url", type="string", length=100)
     */
    private $subscribeUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="unsubscribe_url", type="string", length=100)
     */
    private $unsubscribeUrl;

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
     * Set userid
     *
     * @param integer $userid
     *
     * @return SendyApps
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set appName
     *
     * @param string $appName
     *
     * @return SendyApps
     */
    public function setAppName($appName)
    {
        $this->appName = $appName;

        return $this;
    }

    /**
     * Get appName
     *
     * @return string
     */
    public function getAppName()
    {
        return $this->appName;
    }

    /**
     * Set fromName
     *
     * @param string $fromName
     *
     * @return SendyApps
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
     * @return SendyApps
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
     * @return SendyApps
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
     * Set currency
     *
     * @param string $currency
     *
     * @return SendyApps
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set deliveryFee
     *
     * @param string $deliveryFee
     *
     * @return SendyApps
     */
    public function setDeliveryFee($deliveryFee)
    {
        $this->deliveryFee = $deliveryFee;

        return $this;
    }

    /**
     * Get deliveryFee
     *
     * @return string
     */
    public function getDeliveryFee()
    {
        return $this->deliveryFee;
    }

    /**
     * Set costPerRecipient
     *
     * @param string $costPerRecipient
     *
     * @return SendyApps
     */
    public function setCostPerRecipient($costPerRecipient)
    {
        $this->costPerRecipient = $costPerRecipient;

        return $this;
    }

    /**
     * Get costPerRecipient
     *
     * @return string
     */
    public function getCostPerRecipient()
    {
        return $this->costPerRecipient;
    }

    /**
     * Set smtpHost
     *
     * @param string $smtpHost
     *
     * @return SendyApps
     */
    public function setSmtpHost($smtpHost)
    {
        $this->smtpHost = $smtpHost;

        return $this;
    }

    /**
     * Get smtpHost
     *
     * @return string
     */
    public function getSmtpHost()
    {
        return $this->smtpHost;
    }

    /**
     * Set smtpPort
     *
     * @param string $smtpPort
     *
     * @return SendyApps
     */
    public function setSmtpPort($smtpPort)
    {
        $this->smtpPort = $smtpPort;

        return $this;
    }

    /**
     * Get smtpPort
     *
     * @return string
     */
    public function getSmtpPort()
    {
        return $this->smtpPort;
    }

    /**
     * Set smtpSsl
     *
     * @param string $smtpSsl
     *
     * @return SendyApps
     */
    public function setSmtpSsl($smtpSsl)
    {
        $this->smtpSsl = $smtpSsl;

        return $this;
    }

    /**
     * Get smtpSsl
     *
     * @return string
     */
    public function getSmtpSsl()
    {
        return $this->smtpSsl;
    }

    /**
     * Set smtpUsername
     *
     * @param string $smtpUsername
     *
     * @return SendyApps
     */
    public function setSmtpUsername($smtpUsername)
    {
        $this->smtpUsername = $smtpUsername;

        return $this;
    }

    /**
     * Get smtpUsername
     *
     * @return string
     */
    public function getSmtpUsername()
    {
        return $this->smtpUsername;
    }

    /**
     * Set smtpPassword
     *
     * @param string $smtpPassword
     *
     * @return SendyApps
     */
    public function setSmtpPassword($smtpPassword)
    {
        $this->smtpPassword = $smtpPassword;

        return $this;
    }

    /**
     * Get smtpPassword
     *
     * @return string
     */
    public function getSmtpPassword()
    {
        return $this->smtpPassword;
    }

    /**
     * Set bounceSetup
     *
     * @param integer $bounceSetup
     *
     * @return SendyApps
     */
    public function setBounceSetup($bounceSetup)
    {
        $this->bounceSetup = $bounceSetup;

        return $this;
    }

    /**
     * Get bounceSetup
     *
     * @return int
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
     * @return SendyApps
     */
    public function setCamplaintSetup($complaintSetup)
    {
        $this->complaintSetup = $complaintSetup;

        return $this;
    }

    /**
     * Get complaintSetup
     *
     * @return int
     */
    public function getComplaintSetup()
    {
        return $this->complaintSetup;
    }

    /**
     * Set appKey
     *
     * @param string $appKey
     *
     * @return SendyApps
     */
    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;

        return $this;
    }

    /**
     * Get appKey
     *
     * @return string
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * Set allocatedQuota
     *
     * @param integer $allocatedQuota
     *
     * @return SendyApps
     */
    public function setAllocatedQuota($allocatedQuota)
    {
        $this->allocatedQuota = $allocatedQuota;

        return $this;
    }

    /**
     * Get allocatedQuota
     *
     * @return int
     */
    public function getAllocatedQuota()
    {
        return $this->allocatedQuota;
    }

    /**
     * Set currentQuota
     *
     * @param integer $currentQuota
     *
     * @return SendyApps
     */
    public function setCurrentQuota($currentQuota)
    {
        $this->currentQuota = $currentQuota;

        return $this;
    }

    /**
     * Get currentQuota
     *
     * @return int
     */
    public function getCurrentQuota()
    {
        return $this->currentQuota;
    }

    /**
     * Set dayOfReset
     *
     * @param integer $dayOfReset
     *
     * @return SendyApps
     */
    public function setDayOfReset($dayOfReset)
    {
        $this->dayOfReset = $dayOfReset;

        return $this;
    }

    /**
     * Get dayOfReset
     *
     * @return int
     */
    public function getDayOfReset()
    {
        return $this->dayOfReset;
    }

    /**
     * Set monthOfNextReset
     *
     * @param string $monthOfNextReset
     *
     * @return SendyApps
     */
    public function setMonthOfNextReset($monthOfNextReset)
    {
        $this->monthOfNextReset = $monthOfNextReset;

        return $this;
    }

    /**
     * Get monthOfNextReset
     *
     * @return string
     */
    public function getMonthOfNextReset()
    {
        return $this->monthOfNextReset;
    }

    /**
     * Set testEmail
     *
     * @param string $testEmail
     *
     * @return SendyApps
     */
    public function setTestEmail($testEmail)
    {
        $this->testEmail = $testEmail;

        return $this;
    }

    /**
     * Get testEmail
     *
     * @return string
     */
    public function getTestEmail()
    {
        return $this->testEmail;
    }

    /**
     * Set brandLogoFilename
     *
     * @param string $brandLogoFilename
     *
     * @return SendyApps
     */
    public function setBrandLogoFilename($brandLogoFilename)
    {
        $this->brandLogoFilename = $brandLogoFilename;

        return $this;
    }

    /**
     * Get brandLogoFilename
     *
     * @return string
     */
    public function getBrandLogoFilename()
    {
        return $this->brandLogoFilename;
    }

    /**
     * Set allowedAttachments
     *
     * @param string $allowedAttachments
     *
     * @return SendyApps
     */
    public function setAllowedAttachments($allowedAttachments)
    {
        $this->allowedAttachments = $allowedAttachments;

        return $this;
    }

    /**
     * Get allowedAttachments
     *
     * @return string
     */
    public function getAllowedAttachments()
    {
        return $this->allowedAttachments;
    }

    /**
     * Set reportsOnly
     *
     * @param integer $reportsOnly
     *
     * @return SendyApps
     */
    public function setReportsOnly($reportsOnly)
    {
        $this->reportsOnly = $reportsOnly;

        return $this;
    }

    /**
     * Get reportsOnly
     *
     * @return int
     */
    public function getReportsOnly()
    {
        return $this->reportsOnly;
    }

    /**
     * Add appdetail
     *
     * @param \App\Entity\Template $appdetail
     *
     * @return SendyApps
     */
    public function addAppdetail(\App\Entity\Template $appdetail)
    {
        $this->appdetails[] = $appdetail;

        return $this;
    }

    /**
     * Remove appdetail
     *
     * @param \App\Entity\Template $appdetail
     */
    public function removeAppdetail(\App\Entity\Template $appdetail)
    {
        $this->appdetails->removeElement($appdetail);
    }

    /**
     * Get appdetails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppdetails()
    {
        return $this->appdetails;
    }

    /**
     * Add listdetail
     *
     * @param \App\Entity\Lists $listdetail
     *
     * @return SendyApps
     */
    public function addListdetail(\App\Entity\Lists $listdetail)
    {
        $this->listdetails[] = $listdetail;

        return $this;
    }

    /**
     * Remove listdetail
     *
     * @param \App\Entity\Lists $listdetail
     */
    public function removeListdetail(\App\Entity\Lists $listdetail)
    {
        $this->listdetails->removeElement($listdetail);
    }

    /**
     * Get listdetails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListdetails()
    {
        return $this->listdetails;
    }

    /**
     * Add refadkcategory
     *
     * @param \App\Entity\RefADKCategoryDetails $refadkcategory
     *
     * @return SendyApps
     */
    public function addRefadkcategory(\App\Entity\RefADKCategoryDetails $refadkcategory)
    {
        $this->refadkcategory[] = $refadkcategory;

        return $this;
    }

    /**
     * Remove refadkcategory
     *
     * @param \App\Entity\RefADKCategoryDetails $refadkcategory
     */
    public function removeRefadkcategory(\App\Entity\RefADKCategoryDetails $refadkcategory)
    {
        $this->refadkcategory->removeElement($refadkcategory);
    }

    /**
     * Get refadkcategory
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefadkcategory()
    {
        return $this->refadkcategory;
    }

    /**
     * Set complaintSetup
     *
     * @param integer $complaintSetup
     *
     * @return SendyApps
     */
    public function setComplaintSetup($complaintSetup)
    {
        $this->complaintSetup = $complaintSetup;

        return $this;
    }

    /**
     * Set subscribeUrl
     *
     * @param string $subscribeUrl
     *
     * @return SendyApps
     */
    public function setSubscribeUrl($subscribeUrl)
    {
        $this->subscribeUrl = $subscribeUrl;

        return $this;
    }

    /**
     * Get subscribeUrl
     *
     * @return string
     */
    public function getSubscribeUrl()
    {
        return $this->subscribeUrl;
    }

    /**
     * Set unsubscribeUrl
     *
     * @param string $unsubscribeUrl
     *
     * @return SendyApps
     */
    public function setUnsubscribeUrl($unsubscribeUrl)
    {
        $this->unsubscribeUrl = $unsubscribeUrl;

        return $this;
    }

    /**
     * Get unsubscribeUrl
     *
     * @return string
     */
    public function getUnsubscribeUrl()
    {
        return $this->unsubscribeUrl;
    }
}
