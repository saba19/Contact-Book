<?php

namespace NewProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Phone
 *
 * @ORM\Table(name="phone")
 * @ORM\Entity(repositoryClass="NewProjectBundle\Repository\PhoneRepository")
 */
class Phone
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
     * @ORM\ManyToOne(targetEntity="Upuser", inversedBy="phones")
     * @ORM\JoinColumn(name="upuserId", referencedColumnName="id")
     */
    private $upuser;


    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=20)
     */
    private $number;

 /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=60)
     */
    private $type;




    

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
     * Set number
     *
     * @param string $number
     *
     * @return Phone
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Phone
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set upuser
     *
     * @param \NewProjectBundle\Entity\Upuser $upuser
     *
     * @return Phone
     */
    public function setUpuser(\NewProjectBundle\Entity\Upuser $upuser = null)
    {
        $this->upuser = $upuser;

        return $this;
    }

    /**
     * Get upuser
     *
     * @return \NewProjectBundle\Entity\Upuser
     */
    public function getUpuser()
    {
        return $this->upuser;
    }
}
