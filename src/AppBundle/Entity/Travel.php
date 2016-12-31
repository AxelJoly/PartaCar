<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Travel
 *
 * @ORM\Table(name="travel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TravelRepository")
 */
class Travel
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
     * @var string
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="driver_mail", referencedColumnName="mail")
     */
    private $driver;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="start_id", referencedColumnName="name")
     */
    private $start;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="end_id", referencedColumnName="name")
     */
    private $end;

    /**
     * @var string
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="travels_users",
     *      joinColumns={@ORM\JoinColumn(name="travel_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="mail")}
     *           )
     */
    private $travellers;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time", nullable=true)
     */
    private $time;
    
    /**
     * @var \int
     *
     * @ORM\Column(name="emptySeat", type="integer")
     */
    private $emptySeat;


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
     * Set driver
     *
     * @param string $driver
     *
     * @return Travel
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set start
     *
     * @param string $start
     *
     * @return Travel
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param string $end
     *
     * @return Travel
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return string
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set traveller1
     *
     * @param string $traveller1
     *
     * @return Travel
     */
    public function setTraveller1($traveller1)
    {
        $this->traveller1 = $traveller1;

        return $this;
    }

    /**
     * Get traveller1
     *
     * @return string
     */
    public function getTraveller1()
    {
        return $this->traveller1;
    }

    /**
     * Set traveller2
     *
     * @param string $traveller2
     *
     * @return Travel
     */
    public function setTraveller2($traveller2)
    {
        $this->traveller2 = $traveller2;

        return $this;
    }

    /**
     * Get traveller2
     *
     * @return string
     */
    public function getTraveller2()
    {
        return $this->traveller2;
    }

    /**
     * Set traveller3
     *
     * @param string $traveller3
     *
     * @return Travel
     */
    public function setTraveller3($traveller3)
    {
        $this->traveller3 = $traveller3;

        return $this;
    }

    /**
     * Get traveller3
     *
     * @return string
     */
    public function getTraveller3()
    {
        return $this->traveller3;
    }

    /**
     * Set traveller4
     *
     * @param string $traveller4
     *
     * @return Travel
     */
    public function setTraveller4($traveller4)
    {
        $this->traveller4 = $traveller4;

        return $this;
    }

    /**
     * Get traveller4
     *
     * @return string
     */
    public function getTraveller4()
    {
        return $this->traveller4;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Travel
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Travel
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
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Travel
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function getEmptySeat()
    {
        return $this->emptySeat;
    }

    /**
     * @param int $emptySeat
     */
    public function setEmptySeat($emptySeat)
    {
        $this->emptySeat = $emptySeat;
    }


    
   /* public function __construct() {
    	$this->travellers = new \Doctrine\Common\Collections\ArrayCollection();
    }*/
}

