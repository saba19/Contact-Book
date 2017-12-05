<?php

namespace NewProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Adress
 * @ORM\Table(name="adress")
 * @ORM\Entity(repositoryClass="NewProjectBundle\Repository\AdressRepository")
 */
class Adress
{
    /**
     * @ORM\OneToMany(targetEntity="Upuser", mappedBy="adress")
     */
    private $upusers;
    public function __construct() {
        $this->upusers = new ArrayCollection();
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
     * @ORM\Column(name="city", type="string", length=65)
     */
    private $city;


    /**
     * @var string
     * @ORM\Column(name="street", type="string", length=65)
     */
    private $street;

    /**
     * @var string
     * @ORM\Column(name="house", type="integer", nullable=true)
     */
    private $house;


    /**
     * @var string
     * @ORM\Column(name="flat", type="integer", nullable=true)
     */
    private $flat;


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
     * Set city
     *
     * @param string $city
     *
     * @return Adress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Adress
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set house
     *
     * @param integer $house
     *
     * @return Adress
     */
    public function setHouse($house)
    {
        $this->house = $house;

        return $this;
    }

    /**
     * Get house
     *
     * @return integer
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * Set flat
     *
     * @param integer $flat
     *
     * @return Adress
     */
    public function setFlat($flat)
    {
        $this->flat = $flat;

        return $this;
    }

    /**
     * Get flat
     *
     * @return integer
     */
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * Add upuser
     *
     * @param \NewProjectBundle\Entity\Upuser $upuser
     *
     * @return Adress
     */
    public function addUpuser(\NewProjectBundle\Entity\Upuser $upuser)
    {
        $this->upusers[] = $upuser;

        return $this;
    }

    /**
     * Remove upuser
     *
     * @param \NewProjectBundle\Entity\Upuser $upuser
     */
    public function removeUpuser(\NewProjectBundle\Entity\Upuser $upuser)
    {
        $this->upusers->removeElement($upuser);
    }

    /**
     * Get upusers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUpusers()
    {
        return $this->upusers;
    }
}
