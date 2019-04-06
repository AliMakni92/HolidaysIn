<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationNavire
 *
 * @ORM\Table(name="reservation_navire", indexes={@ORM\Index(name="id", columns={"id"}), @ORM\Index(name="id_navire", columns={"id_navire"})})
 * @ORM\Entity
 */
class ReservationNavire
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     *
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $date;

    /**
     * @var \MyApp\UserBundle\Entity\User
     *@ORM\Id
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    /**
     * @var \MyApp\UserBundle\Entity\Navire
     *@ORM\Id
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\Navire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_navire", referencedColumnName="id_navire")
     * })
     */
    private $idNavire;
    /**
     * @var integer
     *@ORM\Id
     * @ORM\Column(name="nombrePersonne", type="integer", nullable=false)
     */
    private $nombrePersonne;


    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return User
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param User $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Navire
     */
    public function getIdNavire()
    {
        return $this->idNavire;
    }

    /**
     * @param Navire $idNavire
     */
    public function setIdNavire($idNavire)
    {
        $this->idNavire = $idNavire;
    }

    /**
     * @return int
     */
    public function getNombrePersonne()
    {
        return $this->nombrePersonne;
    }

    /**
     * @param int $nombrePersonne
     */
    public function setNombrePersonne($nombrePersonne)
    {
        $this->nombrePersonne = $nombrePersonne;
    }


}

