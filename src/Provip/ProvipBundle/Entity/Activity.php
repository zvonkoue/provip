<?php

namespace Provip\ProvipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="activities")
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     */
    protected $title;

    /**
     *
     * @ORM\Column(type="text")
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     */
    protected $description;

    /**
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotNull()
     * @Assert\DateTime()
     */
    protected $deadline;

    /**
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     */
    protected $state;

    /**
     *
     * @ORM\Column(type="integer", length=12)
     * @Assert\NotNull()
     * @Assert\Type(type="int")
     */
    protected $nbrOfOccurrences;

    /**
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="activities")
     * @ORM\JoinColumn(name="task_id", referencedColumnName="id")
     * @Assert\Valid
     **/
    protected $task;

    /**
     * @ORM\ManyToOne(targetEntity="Application", inversedBy="charter")
     * @ORM\JoinColumn(name="application_id", referencedColumnName="id")
     * @Assert\Valid
     **/
    protected $application;

    /**
     * @ORM\OneToMany(targetEntity="Provip\EventsBundle\Entity\ActivityUpdateEvent", mappedBy="activity")
     * @Assert\Valid
     */
    protected $activityUpdateEvents;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activityUpdateEvents = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Activity
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
     * Set description
     *
     * @param string $description
     * @return Activity
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
     * Set deadline
     *
     * @param \DateTime $deadline
     * @return Activity
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    
        return $this;
    }

    /**
     * Get deadline
     *
     * @return \DateTime 
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Activity
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set nbrOfOccurrences
     *
     * @param integer $nbrOfOccurrences
     * @return Activity
     */
    public function setNbrOfOccurrences($nbrOfOccurrences)
    {
        $this->nbrOfOccurrences = $nbrOfOccurrences;
    
        return $this;
    }

    /**
     * Get nbrOfOccurrences
     *
     * @return integer 
     */
    public function getNbrOfOccurrences()
    {
        return $this->nbrOfOccurrences;
    }

    /**
     * Set task
     *
     * @param \Provip\ProvipBundle\Entity\Task $task
     * @return Activity
     */
    public function setTask(\Provip\ProvipBundle\Entity\Task $task = null)
    {
        $this->task = $task;
    
        return $this;
    }

    /**
     * Get task
     *
     * @return \Provip\ProvipBundle\Entity\Task 
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set application
     *
     * @param \Provip\ProvipBundle\Entity\Application $application
     * @return Activity
     */
    public function setApplication(\Provip\ProvipBundle\Entity\Application $application = null)
    {
        $this->application = $application;
    
        return $this;
    }

    /**
     * Get application
     *
     * @return \Provip\ProvipBundle\Entity\Application 
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * Add activityUpdateEvents
     *
     * @param \Provip\EventsBundle\Entity\ActivityUpdateEvent $activityUpdateEvents
     * @return Activity
     */
    public function addActivityUpdateEvent(\Provip\EventsBundle\Entity\ActivityUpdateEvent $activityUpdateEvents)
    {
        $this->activityUpdateEvents[] = $activityUpdateEvents;
    
        return $this;
    }

    /**
     * Remove activityUpdateEvents
     *
     * @param \Provip\EventsBundle\Entity\ActivityUpdateEvent $activityUpdateEvents
     */
    public function removeActivityUpdateEvent(\Provip\EventsBundle\Entity\ActivityUpdateEvent $activityUpdateEvents)
    {
        $this->activityUpdateEvents->removeElement($activityUpdateEvents);
    }

    /**
     * Get activityUpdateEvents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActivityUpdateEvents()
    {
        return $this->activityUpdateEvents;
    }
}