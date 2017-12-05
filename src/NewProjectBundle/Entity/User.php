<?php

namespace NewProjectBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser

{
    /**
     * @ORM\OneToMany(targetEntity="Upuser", mappedBy="users")
     */
    private $upusers;



    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;


    public function __construct()
    {
        parent::__construct();
        $this->upusers = new ArrayCollection();
    }

    /**
     * Add upuser
     *
     * @param \NewProjectBundle\Entity\Upuser $upuser
     *
     * @return User
     */
    public function addUpuser(\NewProjectBundle\Entity\Upuser $upuser)
    {
        $this->upuser[] = $upuser;

        return $this;
    }

    /**
     * Remove upuser
     *
     * @param \NewProjectBundle\Entity\Upuser $upuser
     */
    public function removeUpuser(\NewProjectBundle\Entity\Upuser $upuser)
    {
        $this->upuser->removeElement($upuser);
    }

    /**
     * Get upuser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUpuser()
    {
        return $this->upuser;
    }
}
