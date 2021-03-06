<?php

namespace Snoozit\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Advert
 *
 * @ORM\Table(name="sz_advert")
 * @ORM\Entity(repositoryClass="Snoozit\PlatformBundle\Entity\AdvertRepository")
 */
class Advert
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=80)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min=3,
     *      max=50,
     *      minMessage="Le titre doit comporter 3 caractères minnimum")
     *      maxMessage="Le titre doit comporter 50 caractères maximum")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z_0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ_ -]{3,50}/",
     *     message="Votre titre ne peut contenir que des chiffres et lettres"
     * )
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="Un tarif ne peut contenir que des chiffres"
     * )
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min=3,
     *      minMessage="La description doit comporter 3 caractères minimum")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z_0-9_ -]/",
     *     message="Votre description ne peut contenir que des chiffres et lettres"
     * )
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="delivery", type="boolean", nullable=true)
     */
    private $delivery;

    /**
     * @var boolean
     *
     * @ORM\Column(name="negotiable", type="boolean", nullable=true)
     */
    private $negotiable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="exchange", type="boolean", nullable=true)
     */
    private $exchange;

    /**
     * @var boolean
     *
     * @ORM\Column(name="private", type="boolean", nullable=true)
     */
    private $private;

    /**
     * @var boolean
     *
     * @ORM\Column(name="urgent", type="boolean", nullable=true)
     */
    private $urgent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="commentable", type="boolean", nullable=true)
     */
    private $commentable;

    /**
     * @ORM\ManyToOne(targetEntity="Snoozit\PlatformBundle\Entity\Categories\Category")
     * @Assert\NotNull(message = "Veuillez séléctionner une categorie")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Snoozit\PlatformBundle\Entity\Localisation\City")
     * @Assert\NotNull(message = "Veuillez sélectionner une ville")
     */
    private $city;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showphone", type="boolean", nullable=true)
     */
    private $showphone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cheque", type="boolean", nullable=true)
     */
    private $cheque;

    /**
     * @var boolean
     *
     * @ORM\Column(name="espece", type="boolean", nullable=true)
     */
    private $espece;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cb", type="boolean", nullable=true)
     */
    private $cb;

    /**
     * @var boolean
     *
     * @ORM\Column(name="paypal", type="boolean", nullable=true)
     */
    private $paypal;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;

    /**
     * @var boolean
     * @ORM\Column(name="success", type="boolean")
     */
    private $success;

    /**
     * @ORM\OneToMany(targetEntity="Snoozit\PlatformBundle\Entity\AdvertComment", mappedBy="advert")
     * @ORM\OrderBy({ "created" = "desc" })
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="Snoozit\PlatformBundle\Entity\AdvertNegoce", mappedBy="advert")
     */
    private $negoces;

    /**
     * @ORM\OneToMany(targetEntity="Snoozit\PlatformBundle\Entity\AdvertInterest", mappedBy="advert")
     */
    private $interested;

    /**
     * @var \DateTime $created

     * @ORM\Column(name="created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @ORM\Column(name="updated", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * @var \DateTime $contentChanged
     *
     * @ORM\Column(name="content_changed", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field={"title", "body"})
     */
    private $contentChanged;

    /**
     * @ORM\ManyToOne(targetEntity = "Snoozit\PlatformBundle\Entity\Guest", cascade={"persist", "remove"} )
     * @ORM\JoinColumn(name="guest_id", referencedColumnName="id", nullable=true)
     * @Assert\Valid()
     */
    private $guest;

    /**
     * @ORM\ManyToOne(targetEntity = "Snoozit\UserBundle\Entity\User", inversedBy="adverts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Snoozit\PlatformBundle\Entity\AdvertPicture",  mappedBy="advert", cascade={"persist", "remove"})
     * @ORM\OrderBy({ "created" = "desc" })
     */
    private $pictures;

    /**
     * @ORM\OneToOne(targetEntity="Snoozit\PlatformBundle\Entity\AdvertPicture", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $pictureOne;

    /**
     * @ORM\OneToOne(targetEntity="Snoozit\PlatformBundle\Entity\AdvertPicture", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $pictureTwo;

    /**
     * @ORM\OneToOne(targetEntity="Snoozit\PlatformBundle\Entity\AdvertPicture",cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $pictureThree;

    /**
     * @ORM\OneToOne(targetEntity="Snoozit\PlatformBundle\Entity\AdvertPicture", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $pictureFour;

    /**
     * @var \DateTime $combinaisonRequest
     * @ORM\Column(name="combinaison_request", type="datetime", nullable=true)
     */
    private $combinaisonRequest;

    /**
     * @var integer
     * @ORM\Column(name="views", type="integer")
     */
    private $views;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=true)
     */
    private $published;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sold", type="boolean", nullable=true)
     */
    private $sold;

    /**
     * @ORM\ManyToOne(targetEntity = "Snoozit\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="sold_to_id", referencedColumnName="id", nullable=true)
     */
    private $soldTo;

    /**
     * @ORM\ManyToOne(targetEntity = "Snoozit\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="in_progress_user_id", referencedColumnName="id", nullable=true)
     */
    private $inProgress;

    public function __construct()
    {
        $this->success = false;
        $this->hash = md5(rand(0, 999999999));
        $this->pictures = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->negotiations = new ArrayCollection();
        $this->views = 0;
        $this->published = true;
        $this->sold = false;
    }

    public function isNew()
    {
        $now = new \DateTime();
        $now->modify('-24 hours');

        if($this->getCreated() < $now){
            return false;
        }

        return true;
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
     * @return Advert
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
     * Set urgent
     *
     * @param integer $urgent
     * @return Advert
     */
    public function setUrgent($urgent)
    {
        $this->urgent = $urgent;

        return $this;
    }

    /**
     * Get urgent
     *
     * @return integer
     */
    public function getUrgent()
    {
        return $this->urgent;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Advert
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Advert
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
     * Set delivery
     *
     * @param boolean $delivery
     * @return Advert
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return boolean
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Set negotiable
     *
     * @param boolean $negotiable
     * @return Advert
     */
    public function setNegotiable($negotiable)
    {
        $this->negotiable = $negotiable;

        return $this;
    }

    /**
     * Get negotiable
     *
     * @return boolean
     */
    public function getNegotiable()
    {
        return $this->negotiable;
    }

    /**
     * Set exchange
     *
     * @param boolean $exchange
     * @return Advert
     */
    public function setExchange($exchange)
    {
        $this->exchange = $exchange;

        return $this;
    }

    /**
     * Get exchange
     *
     * @return boolean
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    /**
     * Set private
     *
     * @param boolean $private
     * @return Advert
     */
    public function setPrivate($private)
    {
        $this->private = $private;

        return $this;
    }

    /**
     * Get private
     *
     * @return boolean
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     * Set commentable
     *
     * @param boolean $commentable
     * @return Advert
     */
    public function setCommentable($commentable)
    {
        $this->commentable = $commentable;

        return $this;
    }

    /**
     * Get commentable
     *
     * @return boolean
     */
    public function getCommentable()
    {
        return $this->commentable;
    }

    /**
     * Set showphone
     *
     * @param boolean $showphone
     * @return Advert
     */
    public function setShowphone($showphone)
    {
        $this->showphone = $showphone;

        return $this;
    }

    /**
     * Get showphone
     *
     * @return boolean
     */
    public function getShowphone()
    {
        return $this->showphone;
    }

    /**
     * Set cheque
     *
     * @param boolean $cheque
     * @return Advert
     */
    public function setCheque($cheque)
    {
        $this->cheque = $cheque;

        return $this;
    }

    /**
     * Get cheque
     *
     * @return boolean
     */
    public function getCheque()
    {
        return $this->cheque;
    }

    /**
     * Set espece
     *
     * @param boolean $espece
     * @return Advert
     */
    public function setEspece($espece)
    {
        $this->espece = $espece;

        return $this;
    }

    /**
     * Get espece
     *
     * @return boolean
     */
    public function getEspece()
    {
        return $this->espece;
    }

    /**
     * Set cb
     *
     * @param boolean $cb
     * @return Advert
     */
    public function setCb($cb)
    {
        $this->cb = $cb;

        return $this;
    }

    /**
     * Get cb
     *
     * @return boolean
     */
    public function getCb()
    {
        return $this->cb;
    }

    /**
     * Set paypal
     *
     * @param boolean $paypal
     * @return boolean
     */
    public function setPaypal($paypal)
    {
        $this->paypal = $paypal;

        return $this;
    }

    /**
     * Get paypal
     *
     * @return Advert
     */
    public function getPaypal()
    {
        return $this->paypal;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Advert
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
     * Set hash
     *
     * @param string $hash
     * @return Advert
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set success
     *
     * @param boolean $success
     * @return Advert
     */
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }

    /**
     * Get success
     *
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Advert
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Advert
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set contentChanged
     *
     * @param \DateTime $contentChanged
     * @return Advert
     */
    public function setContentChanged($contentChanged)
    {
        $this->contentChanged = $contentChanged;

        return $this;
    }

    /**
     * Get contentChanged
     *
     * @return \DateTime
     */
    public function getContentChanged()
    {
        return $this->contentChanged;
    }

    /**
     * Set category
     *
     * @param \Snoozit\PlatformBundle\Entity\Categories\Category $category
     * @return Advert
     */
    public function setCategory(\Snoozit\PlatformBundle\Entity\Categories\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Snoozit\PlatformBundle\Entity\Categories\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set city
     *
     * @param \Snoozit\PlatformBundle\Entity\Localisation\City $city
     * @return Advert
     */
    public function setCity(\Snoozit\PlatformBundle\Entity\Localisation\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Snoozit\PlatformBundle\Entity\Localisation\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Add comments
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertComment $comments
     * @return Advert
     */
    public function addComment(\Snoozit\PlatformBundle\Entity\AdvertComment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertComment $comments
     */
    public function removeComment(\Snoozit\PlatformBundle\Entity\AdvertComment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add negoces
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertNegoce $negoces
     * @return Advert
     */
    public function addNegoce(\Snoozit\PlatformBundle\Entity\AdvertNegoce $negoces)
    {
        $this->negoces[] = $negoces;

        return $this;
    }

    /**
     * Remove negoces
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertNegoce $negoces
     */
    public function removeNegoce(\Snoozit\PlatformBundle\Entity\AdvertNegoce $negoces)
    {
        $this->negoces->removeElement($negoces);
    }

    /**
     * Get negoces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNegoces()
    {
        return $this->negoces;
    }

    /**
     * Set guest
     *
     * @param \Snoozit\PlatformBundle\Entity\Guest $guest
     * @return Advert
     */
    public function setGuest(\Snoozit\PlatformBundle\Entity\Guest $guest = null)
    {
        $this->guest = $guest;

        return $this;
    }

    /**
     * Get guest
     *
     * @return \Snoozit\PlatformBundle\Entity\Guest
     */
    public function getGuest()
    {
        return $this->guest;
    }

    /**
     * Set user
     *
     * @param \Snoozit\UserBundle\Entity\User $user
     * @return Advert
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
     * Add interested
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertComment $interested
     * @return Advert
     */
    public function addInterested(\Snoozit\PlatformBundle\Entity\AdvertComment $interested)
    {
        $this->interested[] = $interested;

        return $this;
    }

    /**
     * Remove interested
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertComment $interested
     */
    public function removeInterested(\Snoozit\PlatformBundle\Entity\AdvertComment $interested)
    {
        $this->interested->removeElement($interested);
    }

    /**
     * Get interested
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterested()
    {
        return $this->interested;
    }

    /**
     * Add pictures
     *
     * @param \SnoozIt\PlatformBundle\Entity\AdvertPicture $pictures
     * @return Advert
     */
    public function addPicture(\Snoozit\PlatformBundle\Entity\AdvertPicture $picture)
    {
        $this->pictures[] = $picture;
        $picture->setAdvert($this);

        return $this;
    }

    /**
     * Remove pictures
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertPicture $pictures
     */
    public function removePicture(\Snoozit\PlatformBundle\Entity\AdvertPicture $picture)
    {
        $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Set pictureOne
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertPicture $pictureOne
     * @return Advert
     */
    public function setPictureOne(\Snoozit\PlatformBundle\Entity\AdvertPicture $pictureOne = null)
    {
        $this->pictureOne = $pictureOne;
        $this->pictureOne->setAdvert($this);

        return $this;
    }

    /**
     * Get pictureOne
     *
     * @return \Snoozit\PlatformBundle\Entity\AdvertPicture
     */
    public function getPictureOne()
    {
        return $this->pictureOne;
    }

    /**
     * Set pictureTwo
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertPicture $pictureTwo
     * @return Advert
     */
    public function setPictureTwo(\Snoozit\PlatformBundle\Entity\AdvertPicture $pictureTwo = null)
    {
        $this->pictureTwo = $pictureTwo;

         $this->pictureTwo->setAdvert($this);

        return $this;
    }

    /**
     * Get pictureTwo
     *
     * @return \Snoozit\PlatformBundle\Entity\AdvertPicture
     */
    public function getPictureTwo()
    {
        return $this->pictureTwo;
    }

    /**
     * Set pictureThree
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertPicture $pictureThree
     * @return Advert
     */
    public function setPictureThree(\Snoozit\PlatformBundle\Entity\AdvertPicture $pictureThree = null)
    {
        $this->pictureThree = $pictureThree;
        $this->pictureThree->setAdvert($this);

        return $this;
    }

    /**
     * Get pictureThree
     *
     * @return \Snoozit\PlatformBundle\Entity\AdvertPicture
     */
    public function getPictureThree()
    {
        return $this->pictureThree;
    }

    /**
     * Set pictureFour
     *
     * @param \Snoozit\PlatformBundle\Entity\AdvertPicture $pictureFour
     * @return Advert
     */
    public function setPictureFour(\Snoozit\PlatformBundle\Entity\AdvertPicture $pictureFour = null)
    {
        $this->pictureFour = $pictureFour;
        $this->pictureFour->setAdvert($this);

        return $this;
    }

    /**
     * Get pictureFour
     *
     * @return \Snoozit\PlatformBundle\Entity\AdvertPicture
     */
    public function getPictureFour()
    {
        return $this->pictureFour;
    }

    public function setCombinaisonRequest($combinaisonRequest)
    {
        $this->combinaisonRequest = $combinaisonRequest;

        return $this;
    }

    public function getCombinaisonRequest()
    {
        return $this->combinaisonRequest;
    }

    /**
     * Set views
     *
     * @param integer $views
     * @return Advert
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get view
     *
     * @return integer 
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Advert
     */
    public function setPubished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPubished()
    {
        return $this->published;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Advert
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set sold
     *
     * @param boolean $sold
     * @return Advert
     */
    public function setSold($sold)
    {
        $this->sold = $sold;

        return $this;
    }

    /**
     * Get sold
     *
     * @return boolean 
     */
    public function getSold()
    {
        return $this->sold;
    }

    /**
     * Set soldTo
     *
     * @param \Snoozit\UserBundle\Entity\User $soldTo
     * @return Advert
     */
    public function setSoldTo(\Snoozit\UserBundle\Entity\User $soldTo = null)
    {
        $this->soldTo = $soldTo;

        return $this;
    }

    /**
     * Get soldTo
     *
     * @return \Snoozit\UserBundle\Entity\User 
     */
    public function getSoldTo()
    {
        return $this->soldTo;
    }

    /**
     * Set inProgess
     *
     * @param \Snoozit\UserBundle\Entity\User $inProgess
     * @return Advert
     */
    public function setInProgress(\Snoozit\UserBundle\Entity\User $inProgress = null)
    {
        $this->inProgress = $inProgress;

        return $this;
    }

    /**
     * Get inProgress
     *
     * @return \Snoozit\UserBundle\Entity\User 
     */
    public function getInProgress()
    {
        return $this->inProgress;
    }
}
