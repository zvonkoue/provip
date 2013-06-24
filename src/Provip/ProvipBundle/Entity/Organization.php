<?php

namespace Provip\ProvipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="organizations")
 *
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"company" = "Company", "hei" = "HigherEducationalInstitution"})
 *
 */
abstract class Organization
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
    protected $name;

    /**
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Country
     * @Assert\NotNull()
     */
    protected $country;

    /**
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     */
    protected $field;

    /**
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     */
    protected $url;

    /**
     * @ORM\Column(length=255, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    protected $slug;

    /**
     * Official Company Language
     *
     *
     * @ORM\OneToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     *
     * @Assert\Valid
     */
    protected $language;

    /**
     * supportedLanguages is a collection of other languages spoken in this company
     *
     *
     * @ORM\ManyToMany(targetEntity="Language")
     * @ORM\JoinTable(name="organisations_supportedlanguages",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="language_id", referencedColumnName="id", unique=true)}
     *      )
     * @Assert\Valid
     */
    protected $supportedLanguages;

    /**
     * @ORM\OneToMany(targetEntity="Provip\UserBundle\Entity\User", mappedBy="organization")
    * @Assert\Valid
     */
    protected $staff;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->supportedLanguages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->staff = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Organization
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
     * Set country
     *
     * @param string $country
     * @return Organization
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set field
     *
     * @param string $field
     * @return Organization
     */
    public function setField($field)
    {
        $this->field = $field;
    
        return $this;
    }

    /**
     * Get field
     *
     * @return string 
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Organization
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Organization
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set language
     *
     * @param \Provip\ProvipBundle\Entity\Language $language
     * @return Organization
     */
    public function setLanguage(\Provip\ProvipBundle\Entity\Language $language = null)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return \Provip\ProvipBundle\Entity\Language 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Add supportedLanguages
     *
     * @param \Provip\ProvipBundle\Entity\Language $supportedLanguages
     * @return Organization
     */
    public function addSupportedLanguage(\Provip\ProvipBundle\Entity\Language $supportedLanguages)
    {
        $this->supportedLanguages[] = $supportedLanguages;
    
        return $this;
    }

    /**
     * Remove supportedLanguages
     *
     * @param \Provip\ProvipBundle\Entity\Language $supportedLanguages
     */
    public function removeSupportedLanguage(\Provip\ProvipBundle\Entity\Language $supportedLanguages)
    {
        $this->supportedLanguages->removeElement($supportedLanguages);
    }

    /**
     * Get supportedLanguages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSupportedLanguages()
    {
        return $this->supportedLanguages;
    }

    /**
     * Add staff
     *
     * @param \Provip\UserBundle\Entity\User $staff
     * @return Organization
     */
    public function addStaff(\Provip\UserBundle\Entity\User $staff)
    {
        $this->staff[] = $staff;
    
        return $this;
    }

    /**
     * Remove staff
     *
     * @param \Provip\UserBundle\Entity\User $staff
     */
    public function removeStaff(\Provip\UserBundle\Entity\User $staff)
    {
        $this->staff->removeElement($staff);
    }

    /**
     * Get staff
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStaff()
    {
        return $this->staff;
    }
}