<?php

namespace NewProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity(repositoryClass="NewProjectBundle\Repository\EmailRepository")
 */
class Email
{
    /**
     * @ORM\ManyToOne(targetEntity="Upuser", inversedBy="emails")
     * @ORM\JoinColumn(name="upuserId", referencedColumnName="id")
     */
    private $upuser;



    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;

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
     * Set email
     *
     * @param string $email
     *
     * @return Email
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Email
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
     * @return Email
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
