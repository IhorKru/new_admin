<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatsDaily
 *
 * @ORM\Table(name="stats_daily")
 * @ORM\Entity(repositoryClass="App\Repository\StatsDailyRepository")
 */
class StatsDaily
{
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
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var int
     *
     * @ORM\Column(name="month", type="integer")
     */
    private $month;

    /**
     * @var int
     *
     * @ORM\Column(name="week", type="integer")
     */
    private $week;

    /**
     * @var int
     *
     * @ORM\Column(name="day", type="integer")
     */
    private $day;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="subscribers", type="integer")
     */
    private $subscribers;

    /**
     * @var int
     *
     * @ORM\Column(name="subscribersperiod", type="integer")
     */
    private $subscribersperiod;

    /**
     * @var int
     *
     * @ORM\Column(name="unsubscribers", type="integer")
     */
    private $unsubscribers;
    
    /**
     * @var int
     *
     * @ORM\Column(name="unsubscribersperiod", type="integer")
     */
    private $unsubscribersperiod;

    /**
     * @var int
     *
     * @ORM\Column(name="batches", type="integer")
     */
    private $batches;

    /**
     * @var int
     *
     * @ORM\Column(name="batchesperiod", type="integer")
     */
    private $batchesperiod;

    /**
     * @var int
     *
     * @ORM\Column(name="campaigns", type="integer")
     */
    private $campaignssent;
    
     /**
     * @var int
     *
     * @ORM\Column(name="campaignsperiod", type="integer")
     */
    private $campaignsperiod;

    /**
     * @var int
     *
     * @ORM\Column(name="emailssent", type="integer")
     */
    private $emailssent;
    
    /**
     * @var int
     *
     * @ORM\Column(name="emailssentperiod", type="integer")
     */
    private $emailssentperiod;

    /**
     * @var int
     *
     * @ORM\Column(name="revenue", type="integer")
     */
    private $revenue;
    
    /**
     * @var int
     *
     * @ORM\Column(name="revenueperiod", type="integer")
     */
    private $revenueperiod;

    /**
     * @var int
     *
     * @ORM\Column(name="opens", type="integer")
     */
    private $opens;

    /**
     * @var int
     *
     * @ORM\Column(name="opensperiod", type="integer")
     */
    private $opensperiod;

    /**
     * @var int
     *
     * @ORM\Column(name="clicks", type="integer")
     */
    private $clicks;
    
    /**
     * @var int
     *
     * @ORM\Column(name="clicksperiod", type="integer")
     */
    private $clicksperiod;

    /**
     * @var int
     *
     * @ORM\Column(name="bounces", type="integer")
     */
    private $bounces;

    /**
     * @var int
     *
     * @ORM\Column(name="bouncesperiod", type="integer")
     */
    private $bouncesperiod;

    /**
     * @var int
     *
     * @ORM\Column(name="complaints", type="integer")
     */
    private $complaints;

    /**
     * @var int
     *
     * @ORM\Column(name="complaintsperiod", type="integer")
     */
    private $complaintsperiod;

    /**
     * @var int
     *
     * @ORM\Column(name="spend", type="float")
     */
    private $spend;

    /**
     * @var int
     *
     * @ORM\Column(name="spendperiod", type="float")
     */
    private $spendperiod;

    /**
     * @var int
     *
     * @ORM\Column(name="validemails", type="float")
     */
    private $validemails;

    /**
     * @var int
     *
     * @ORM\Column(name="validbutmissing", type="float")
     */
    private $validbutmissing;

    /**
     * @var int
     *
     * @ORM\Column(name="invalidemails", type="float")
     */
    private $invalidemails;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datemodified", type="datetime")
     */
    private $datemodified;


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
     * Set year
     *
     * @param integer $year
     *
     * @return StatsDaily
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set month
     *
     * @param integer $month
     *
     * @return StatsDaily
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return integer
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set week
     *
     * @param integer $week
     *
     * @return StatsDaily
     */
    public function setWeek($week)
    {
        $this->week = $week;

        return $this;
    }

    /**
     * Get week
     *
     * @return integer
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * Set day
     *
     * @param integer $day
     *
     * @return StatsDaily
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return StatsDaily
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set subscribers
     *
     * @param integer $subscribers
     *
     * @return StatsDaily
     */
    public function setSubscribers($subscribers)
    {
        $this->subscribers = $subscribers;

        return $this;
    }

    /**
     * Get subscribers
     *
     * @return integer
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * Set subscribersperiod
     *
     * @param integer $subscribersperiod
     *
     * @return StatsDaily
     */
    public function setSubscribersperiod($subscribersperiod)
    {
        $this->subscribersperiod = $subscribersperiod;

        return $this;
    }

    /**
     * Get subscribersperiod
     *
     * @return integer
     */
    public function getSubscribersperiod()
    {
        return $this->subscribersperiod;
    }

    /**
     * Set unsubscribers
     *
     * @param integer $unsubscribers
     *
     * @return StatsDaily
     */
    public function setUnsubscribers($unsubscribers)
    {
        $this->unsubscribers = $unsubscribers;

        return $this;
    }

    /**
     * Get unsubscribers
     *
     * @return integer
     */
    public function getUnsubscribers()
    {
        return $this->unsubscribers;
    }

    /**
     * Set unsubscribersperiod
     *
     * @param integer $unsubscribersperiod
     *
     * @return StatsDaily
     */
    public function setUnsubscribersperiod($unsubscribersperiod)
    {
        $this->unsubscribersperiod = $unsubscribersperiod;

        return $this;
    }

    /**
     * Get unsubscribersperiod
     *
     * @return integer
     */
    public function getUnsubscribersperiod()
    {
        return $this->unsubscribersperiod;
    }

    /**
     * Set campaignssent
     *
     * @param integer $campaignssent
     *
     * @return StatsDaily
     */
    public function setCampaignssent($campaignssent)
    {
        $this->campaignssent = $campaignssent;

        return $this;
    }

    /**
     * Get campaignssent
     *
     * @return integer
     */
    public function getCampaignssent()
    {
        return $this->campaignssent;
    }

    /**
     * Set campaignsperiod
     *
     * @param integer $campaignsperiod
     *
     * @return StatsDaily
     */
    public function setCampaignsperiod($campaignsperiod)
    {
        $this->campaignsperiod = $campaignsperiod;

        return $this;
    }

    /**
     * Get campaignsperiod
     *
     * @return integer
     */
    public function getCampaignsperiod()
    {
        return $this->campaignsperiod;
    }

    /**
     * Set emailssent
     *
     * @param integer $emailssent
     *
     * @return StatsDaily
     */
    public function setEmailssent($emailssent)
    {
        $this->emailssent = $emailssent;

        return $this;
    }

    /**
     * Get emailssent
     *
     * @return integer
     */
    public function getEmailssent()
    {
        return $this->emailssent;
    }

    /**
     * Set emailssentperiod
     *
     * @param integer $emailssentperiod
     *
     * @return StatsDaily
     */
    public function setEmailssentperiod($emailssentperiod)
    {
        $this->emailssentperiod = $emailssentperiod;

        return $this;
    }

    /**
     * Get emailssentperiod
     *
     * @return integer
     */
    public function getEmailssentperiod()
    {
        return $this->emailssentperiod;
    }

    /**
     * Set revenue
     *
     * @param integer $revenue
     *
     * @return StatsDaily
     */
    public function setRevenue($revenue)
    {
        $this->revenue = $revenue;

        return $this;
    }

    /**
     * Get revenue
     *
     * @return integer
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * Set revenueperiod
     *
     * @param integer $revenueperiod
     *
     * @return StatsDaily
     */
    public function setRevenueperiod($revenueperiod)
    {
        $this->revenueperiod = $revenueperiod;

        return $this;
    }

    /**
     * Get revenueperiod
     *
     * @return integer
     */
    public function getRevenueperiod()
    {
        return $this->revenueperiod;
    }

    /**
     * Set clicks
     *
     * @param integer $clicks
     *
     * @return StatsDaily
     */
    public function setClicks($clicks)
    {
        $this->clicks = $clicks;

        return $this;
    }

    /**
     * Get clicks
     *
     * @return integer
     */
    public function getClicks()
    {
        return $this->clicks;
    }

    /**
     * Set clicksperiod
     *
     * @param integer $clicksperiod
     *
     * @return StatsDaily
     */
    public function setClicksperiod($clicksperiod)
    {
        $this->clicksperiod = $clicksperiod;

        return $this;
    }

    /**
     * Get clicksperiod
     *
     * @return integer
     */
    public function getClicksperiod()
    {
        return $this->clicksperiod;
    }

    /**
     * Set datemodified
     *
     * @param \DateTime $datemodified
     *
     * @return StatsDaily
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
     * Set batches
     *
     * @param integer $batches
     *
     * @return StatsDaily
     */
    public function setBatches($batches)
    {
        $this->batches = $batches;

        return $this;
    }

    /**
     * Get batches
     *
     * @return integer
     */
    public function getBatches()
    {
        return $this->batches;
    }

    /**
     * Set batchesperiod
     *
     * @param integer $batchesperiod
     *
     * @return StatsDaily
     */
    public function setBatchesperiod($batchesperiod)
    {
        $this->batchesperiod = $batchesperiod;

        return $this;
    }

    /**
     * Get batchesperiod
     *
     * @return integer
     */
    public function getBatchesperiod()
    {
        return $this->batchesperiod;
    }

    /**
     * Set opens
     *
     * @param integer $opens
     *
     * @return StatsDaily
     */
    public function setOpens($opens)
    {
        $this->opens = $opens;

        return $this;
    }

    /**
     * Get opens
     *
     * @return integer
     */
    public function getOpens()
    {
        return $this->opens;
    }

    /**
     * Set opensperiod
     *
     * @param integer $opensperiod
     *
     * @return StatsDaily
     */
    public function setOpensperiod($opensperiod)
    {
        $this->opensperiod = $opensperiod;

        return $this;
    }

    /**
     * Get opensperiod
     *
     * @return integer
     */
    public function getOpensperiod()
    {
        return $this->opensperiod;
    }

    /**
     * Set bounces
     *
     * @param integer $bounces
     *
     * @return StatsDaily
     */
    public function setBounces($bounces)
    {
        $this->bounces = $bounces;

        return $this;
    }

    /**
     * Get bounces
     *
     * @return integer
     */
    public function getBounces()
    {
        return $this->bounces;
    }

    /**
     * Set bouncesperiod
     *
     * @param integer $bouncesperiod
     *
     * @return StatsDaily
     */
    public function setBouncesperiod($bouncesperiod)
    {
        $this->bouncesperiod = $bouncesperiod;

        return $this;
    }

    /**
     * Get bouncesperiod
     *
     * @return integer
     */
    public function getBouncesperiod()
    {
        return $this->bouncesperiod;
    }

    /**
     * Set spend
     *
     * @param float $spend
     *
     * @return StatsDaily
     */
    public function setSpend($spend)
    {
        $this->spend = $spend;

        return $this;
    }

    /**
     * Get spend
     *
     * @return float
     */
    public function getSpend()
    {
        return $this->spend;
    }

    /**
     * Set spendperiod
     *
     * @param float $spendperiod
     *
     * @return StatsDaily
     */
    public function setSpendperiod($spendperiod)
    {
        $this->spendperiod = $spendperiod;

        return $this;
    }

    /**
     * Get spendperiod
     *
     * @return float
     */
    public function getSpendperiod()
    {
        return $this->spendperiod;
    }

    /**
     * Set complaints
     *
     * @param integer $complaints
     *
     * @return StatsDaily
     */
    public function setComplaints($complaints)
    {
        $this->complaints = $complaints;

        return $this;
    }

    /**
     * Get complaints
     *
     * @return integer
     */
    public function getComplaints()
    {
        return $this->complaints;
    }

    /**
     * @return int
     */
    public function getValidemails(): int
    {
        return $this->validemails;
    }

    /**
     * @param int $validemails
     */
    public function setValidemails(int $validemails): void
    {
        $this->validemails = $validemails;
    }

    /**
     * @return int
     */
    public function getValidbutmissing(): int
    {
        return $this->validbutmissing;
    }

    /**
     * @param int $validbutmissing
     */
    public function setValidbutmissing(int $validbutmissing): void
    {
        $this->validbutmissing = $validbutmissing;
    }

    /**
     * @return int
     */
    public function getInvalidemails(): int
    {
        return $this->invalidemails;
    }

    /**
     * @param int $invalidemails
     */
    public function setInvalidemails(int $invalidemails): void
    {
        $this->invalidemails = $invalidemails;
    }

    /**
     * Set complaintsperiod
     *
     * @param integer $complaintsperiod
     *
     * @return StatsDaily
     */
    public function setComplaintsperiod($complaintsperiod)
    {
        $this->complaintsperiod = $complaintsperiod;

        return $this;
    }

    /**
     * Get complaintsperiod
     *
     * @return integer
     */
    public function getComplaintsperiod()
    {
        return $this->complaintsperiod;
    }


}
