<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Lists
 *
 * @ORM\Table(name="lists")
 * @ORM\Entity(repositoryClass="App\Repository\ListsRepository")
 */
class Lists
{

    /**
     *@ORM\OneToMany(targetEntity="Subscribers", mappedBy="list", cascade={"persist"})
     */
    private $subscribers;

    public function __construct()
    {
        $this->subscribers = new ArrayCollection();
    }

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
     * @ORM\ManyToOne(targetEntity="SendyApps", inversedBy="listdetails", cascade={"persist"})
     * @ORM\JoinColumn(name="app", referencedColumnName="id")
     *
     */
    private $app;

    /**
     * @var integer
     *
     * @ORM\Column(name="userID", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="opt_in", type="integer", nullable=true)
     */
    private $opt_in;

    /**
     * @var string
     *
     * @ORM\Column(name="confirm_url", type="string", length=100, nullable=true)
     */
    private $confirm_url;

    /**
     * @var string
     *
     * @ORM\Column(name="subscribed_url", type="string", length=100, nullable=true)
     */
    private $subscribed_url;

    /**
     * @var string
     *
     * @ORM\Column(name="unsubscribed_url", type="string", length=100, nullable=true)
     */
    private $unsubscribed_url;

    /**
     * @var integer
     *
     * @ORM\Column(name="thankyou", type="integer", nullable=true)
     */
    private $thankyou;

    /**
     * @var string
     *
     * @ORM\Column(name="thankyou_subject", type="string", length=100, nullable=true)
     */
    private $thankyou_subject;

    /**
     * @var string
     *
     * @ORM\Column(name="thankyou_message", type="text", nullable=true)
     */
    private $thankyou_message;

    /**
     * @var integer
     *
     * @ORM\Column(name="goodbye", type="integer", nullable=true)
     */
    private $goodbye;

    /**
     * @var string
     *
     * @ORM\Column(name="goodbye_subject", type="string", length=100, nullable=true)
     */
    private $goodbye_subject;

    /**
     * @var string
     *
     * @ORM\Column(name="goodbye_message", type="text", nullable=true)
     */
    private $goodbye_message;

    /**
     * @var string
     *
     * @ORM\Column(name="confirmation_subject", type="text", nullable=true)
     */
    private $confirmation_subject;

    /**
     * @var string
     *
     * @ORM\Column(name="confirmation_email", type="text", nullable=true)
     */
    private $confirmation_email;

    /**
     * @var integer
     *
     * @ORM\Column(name="unsubscribe_all_list", type="integer", nullable=true)
     */
    private $unsubscribe_all_list;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_fields", type="text", nullable=true)
     */
    private $custom_fields;

    /**
     * @var integer
     *
     * @ORM\Column(name="prev_count", type="integer", nullable=true)
     */
    private $prev_count;

    /**
     * @var integer
     *
     * @ORM\Column(name="currently_processing", type="integer", nullable=true)
     */
    private $currently_processing;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_records", type="integer", nullable=true)
     */
    private $total_records;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Lists
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
     * Set app
     *
     * @param integer $app
     *
     * @return Lists
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
     * Set userid
     *
     * @param integer $userid
     *
     * @return Lists
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
     * Set name
     *
     * @param string $name
     *
     * @return Lists
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
     * Set optIn
     *
     * @param integer $optIn
     *
     * @return Lists
     */
    public function setOptIn($optIn)
    {
        $this->opt_in = $optIn;

        return $this;
    }

    /**
     * Get optIn
     *
     * @return integer
     */
    public function getOptIn()
    {
        return $this->opt_in;
    }

    /**
     * Set confirmUrl
     *
     * @param string $confirmUrl
     *
     * @return Lists
     */
    public function setConfirmUrl($confirmUrl)
    {
        $this->confirm_url = $confirmUrl;

        return $this;
    }

    /**
     * Get confirmUrl
     *
     * @return string
     */
    public function getConfirmUrl()
    {
        return $this->confirm_url;
    }

    /**
     * Set subscribedUrl
     *
     * @param string $subscribedUrl
     *
     * @return Lists
     */
    public function setSubscribedUrl($subscribedUrl)
    {
        $this->subscribed_url = $subscribedUrl;

        return $this;
    }

    /**
     * Get subscribedUrl
     *
     * @return string
     */
    public function getSubscribedUrl()
    {
        return $this->subscribed_url;
    }

    /**
     * Set unsubscribedUrl
     *
     * @param string $unsubscribedUrl
     *
     * @return Lists
     */
    public function setUnsubscribedUrl($unsubscribedUrl)
    {
        $this->unsubscribed_url = $unsubscribedUrl;

        return $this;
    }

    /**
     * Get unsubscribedUrl
     *
     * @return string
     */
    public function getUnsubscribedUrl()
    {
        return $this->unsubscribed_url;
    }

    /**
     * Set thankyou
     *
     * @param integer $thankyou
     *
     * @return Lists
     */
    public function setThankyou($thankyou)
    {
        $this->thankyou = $thankyou;

        return $this;
    }

    /**
     * Get thankyou
     *
     * @return integer
     */
    public function getThankyou()
    {
        return $this->thankyou;
    }

    /**
     * Set thankyouSubject
     *
     * @param string $thankyouSubject
     *
     * @return Lists
     */
    public function setThankyouSubject($thankyouSubject)
    {
        $this->thankyou_subject = $thankyouSubject;

        return $this;
    }

    /**
     * Get thankyouSubject
     *
     * @return string
     */
    public function getThankyouSubject()
    {
        return $this->thankyou_subject;
    }

    /**
     * Set thankyouMessage
     *
     * @param string $thankyouMessage
     *
     * @return Lists
     */
    public function setThankyouMessage($thankyouMessage)
    {
        $this->thankyou_message = $thankyouMessage;

        return $this;
    }

    /**
     * Get thankyouMessage
     *
     * @return string
     */
    public function getThankyouMessage()
    {
        return $this->thankyou_message;
    }

    /**
     * Set goodbye
     *
     * @param integer $goodbye
     *
     * @return Lists
     */
    public function setGoodbye($goodbye)
    {
        $this->goodbye = $goodbye;

        return $this;
    }

    /**
     * Get goodbye
     *
     * @return integer
     */
    public function getGoodbye()
    {
        return $this->goodbye;
    }

    /**
     * Set goodbyeSubject
     *
     * @param string $goodbyeSubject
     *
     * @return Lists
     */
    public function setGoodbyeSubject($goodbyeSubject)
    {
        $this->goodbye_subject = $goodbyeSubject;

        return $this;
    }

    /**
     * Get goodbyeSubject
     *
     * @return string
     */
    public function getGoodbyeSubject()
    {
        return $this->goodbye_subject;
    }

    /**
     * Set goodbyeMessage
     *
     * @param string $goodbyeMessage
     *
     * @return Lists
     */
    public function setGoodbyeMessage($goodbyeMessage)
    {
        $this->goodbye_message = $goodbyeMessage;

        return $this;
    }

    /**
     * Get goodbyeMessage
     *
     * @return string
     */
    public function getGoodbyeMessage()
    {
        return $this->goodbye_message;
    }

    /**
     * Set confirmationSubject
     *
     * @param string $confirmationSubject
     *
     * @return Lists
     */
    public function setConfirmationSubject($confirmationSubject)
    {
        $this->confirmation_subject = $confirmationSubject;

        return $this;
    }

    /**
     * Get confirmationSubject
     *
     * @return string
     */
    public function getConfirmationSubject()
    {
        return $this->confirmation_subject;
    }

    /**
     * Set confirmationEmail
     *
     * @param string $confirmationEmail
     *
     * @return Lists
     */
    public function setConfirmationEmail($confirmationEmail)
    {
        $this->confirmation_email = $confirmationEmail;

        return $this;
    }

    /**
     * Get confirmationEmail
     *
     * @return string
     */
    public function getConfirmationEmail()
    {
        return $this->confirmation_email;
    }

    /**
     * Set unsubscribeAllList
     *
     * @param integer $unsubscribeAllList
     *
     * @return Lists
     */
    public function setUnsubscribeAllList($unsubscribeAllList)
    {
        $this->unsubscribe_all_list = $unsubscribeAllList;

        return $this;
    }

    /**
     * Get unsubscribeAllList
     *
     * @return integer
     */
    public function getUnsubscribeAllList()
    {
        return $this->unsubscribe_all_list;
    }

    /**
     * Set customFields
     *
     * @param string $customFields
     *
     * @return Lists
     */
    public function setCustomFields($customFields)
    {
        $this->custom_fields = $customFields;

        return $this;
    }

    /**
     * Get customFields
     *
     * @return string
     */
    public function getCustomFields()
    {
        return $this->custom_fields;
    }

    /**
     * Set prevCount
     *
     * @param integer $prevCount
     *
     * @return Lists
     */
    public function setPrevCount($prevCount)
    {
        $this->prev_count = $prevCount;

        return $this;
    }

    /**
     * Get prevCount
     *
     * @return integer
     */
    public function getPrevCount()
    {
        return $this->prev_count;
    }

    /**
     * Set currentlyProcessing
     *
     * @param integer $currentlyProcessing
     *
     * @return Lists
     */
    public function setCurrentlyProcessing($currentlyProcessing)
    {
        $this->currently_processing = $currentlyProcessing;

        return $this;
    }

    /**
     * Get currentlyProcessing
     *
     * @return integer
     */
    public function getCurrentlyProcessing()
    {
        return $this->currently_processing;
    }

    /**
     * Set totalRecords
     *
     * @param integer $totalRecords
     *
     * @return Lists
     */
    public function setTotalRecords($totalRecords)
    {
        $this->total_records = $totalRecords;

        return $this;
    }

    /**
     * Get totalRecords
     *
     * @return integer
     */
    public function getTotalRecords()
    {
        return $this->total_records;
    }

    /**
     * Add subscriber
     *
     * @param \App\Entity\Subscribers $subscriber
     *
     * @return Lists
     */
    public function addSubscriber(\App\Entity\Subscribers $subscriber)
    {
        $this->subscribers[] = $subscriber;

        return $this;
    }

    /**
     * Remove subscriber
     *
     * @param \App\Entity\Subscribers $subscriber
     */
    public function removeSubscriber(\App\Entity\Subscribers $subscriber)
    {
        $this->subscribers->removeElement($subscriber);
    }

    /**
     * Get subscribers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }
}
