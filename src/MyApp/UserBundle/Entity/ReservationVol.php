<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationVol
 *
 * @ORM\Table(name="reservation_vol", indexes={@ORM\Index(name="id", columns={"id"}), @ORM\Index(name="num_vol", columns={"num_vol"})})
 * @ORM\Entity
 */
class ReservationVol
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \MyApp\UserBundle\Entity\Vol
     * @ORM\OneToOne(targetEntity="MyApp\UserBundle\Entity\Vol")
     *  @ORM\Id
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="num_vol", referencedColumnName="num_vol", unique=false)
     * })
     */
    private $numVol;

    /**
     * @var \MyApp\UserBundle\Entity\User
     * @ORM\OneToOne(targetEntity="MyApp\UserBundle\Entity\User")
     *  @ORM\Id
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id", referencedColumnName="id", unique=false)
     * })
     */
    private $id;
    /**
     * @var integer
     * @ORM\Id
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
     * @return Vol
     */
    public function getNumVol()
    {
        return $this->numVol;
    }

    /**
     * @param Vol $numVol
     */
    public function setNumVol($numVol)
    {
        $this->numVol = $numVol;
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