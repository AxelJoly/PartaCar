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
     * @var int
     *
     * @ORM\Column(name="emptySeat", type="integer")
     */
    private $emptySeat;
    
    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="travels")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;


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


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->travellers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add traveller
     *
     * @param \AppBundle\Entity\User $traveller
     *
     * @return Travel
     */
    public function addTraveller(\AppBundle\Entity\User $traveller)
    {
        $this->travellers[] = $traveller;

        return $this;
    }

    /**
     * Remove traveller
     *
     * @param \AppBundle\Entity\User $traveller
     */
    public function removeTraveller(\AppBundle\Entity\User $traveller)
    {
        $this->travellers->removeElement($traveller);
    }

    /**
     * Get travellers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTravellers()
    {
        return $this->travellers;
    }

    /**
     * Set event
     *
     * @param \AppBundle\Entity\Event $event
     *
     * @return Travel
     */
    public function setEvent(\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \AppBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }
}
