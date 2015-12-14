<?php

namespace Snoozit\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AdvertChatEngine
 *
 * @ORM\Table(name="sz_advert_chat_engine")
 * @ORM\Entity(repositoryClass="Snoozit\PlatformBundle\Entity\AdvertChatEngineRepository")
 */
class AdvertChatEngine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Snoozit\PlatformBundle\Entity\Advert", inversedBy="interested")
     * @ORM\JoinColumn(name="advert_id", referencedColumnName="id")
     */
    private $advert;

    /**
     * @var \DateTime $created

     * @ORM\Column(name="created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * @ORM\OneToMany(targetEntity="Snoozit\PlatformBundle\Entity\AdvertChatMessage", mappedBy="chatEngineId", cascade={"persist", "remove"})
     * @ORM\OrderBy({ "created" = "desc" })
     */
    protected $mesages;

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
     * Set created
     *
     * @param \DateTime $created
     * @return AdvertChatEngine
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set user
     *
     * @param \Snoozit\UserBundle\Entity\User $user
     * @return AdvertChatEngine
     */
    public function setUser(\Snoozit\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Snoozit\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set advert
     *
     * @param \Snoozit\PlatformBundle\Entity\Advert $advert
     * @return AdvertChatEngine
     */
    public function setAdvert(\Snoozit\PlatformBundle\Entity\Advert $advert = null)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \Snoozit\PlatformBundle\Entity\Advert 
     */
    public function getAdvert()
    {
        return $this->advert;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mesages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add mesages
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertChatMessage $mesages
     * @return AdvertChatEngine
     */
    public function addMesage(\Snoozit\PlatformBundle\Entity\AdvertChatMessage $mesages)
    {
        $this->mesages[] = $mesages;

        return $this;
    }

    /**
     * Remove mesages
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertChatMessage $mesages
     */
    public function removeMesage(\Snoozit\PlatformBundle\Entity\AdvertChatMessage $mesages)
    {
        $this->mesages->removeElement($mesages);
    }

    /**
     * Get mesages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMesages()
    {
        return $this->mesages;
    }
}
