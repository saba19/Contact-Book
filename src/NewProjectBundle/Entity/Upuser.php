<?php

namespace NewProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Upuser
 *
 * @ORM\Table(name="upuser")
 * @ORM\Entity(repositoryClass="NewProjectBundle\Repository\UpuserRepository")
 */
class Upuser
{
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $users;


    /**
     * @ORM\ManyToOne(targetEntity="Adress")
     * @ORM\JoinColumn(name="adress_id", referencedColumnName="id")
     */
    private $adress;


    /**
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="upuser")
     */
    private $phones;


    /**
     * @ORM\OneToMany(targetEntity="Email"
    , mappedBy="upuser")
     */
    private $emails;


    public function __construct() {
        $this->emails = new ArrayCollection();
        $this->phones = new ArrayCollection();
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=100)
     */
    private $surname;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;




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
     *
     * @return Upuser
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
     * Set surname
     *
     * @param string $surname
     *
     * @return Upuser
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Upuser
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
     * Set adress
     *
     * @param \NewProjectBundle\Entity\Adress $adress
     *
     * @return Upuser
     */
    public function setAdress(\NewProjectBundle\Entity\Adress $adress = null)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return \NewProjectBundle\Entity\Adress
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Add phone
     *
     * @param \NewProjectBundle\Entity\Phone $phone
     *
     * @return Upuser
     */
    public function addPhone(\NewProjectBundle\Entity\Phone $phone)
    {
        $this->phones[] = $phone;

        return $this;
    }

    /**
     * Remove phone
     *
     * @param \NewProjectBundle\Entity\Phone $phone
     */
    public function removePhone(\NewProjectBundle\Entity\Phone $phone)
    {
        $this->phones->removeElement($phone);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Add email
     *
     * @param \NewProjectBundle\Entity\Email $email
     *
     * @return Upuser
     */
    public function addEmail(\NewProjectBundle\Entity\Email $email)
    {
        $this->emails[] = $email;

        return $this;
    }

    /**
     * Remove email
     *
     * @param \NewProjectBundle\Entity\Email $email
     */
    public function removeEmail(\NewProjectBundle\Entity\Email $email)
    {
        $this->emails->removeElement($email);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Set user
     *
     * @param \NewProjectBundle\Entity\User $user
     *
     * @return Upuser
     */
    public function setUser(\NewProjectBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \NewProjectBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
