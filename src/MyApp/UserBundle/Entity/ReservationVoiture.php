<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * ReservationVoiture
 *
 * @ORM\Table(name="reservation_voiture", indexes={@ORM\Index(name="num_voiture", columns={"num_voiture"}), @ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity(repositoryClass ="MyApp\UserBundle\Entity\ReservationVoitureRepository")
 */
class ReservationVoiture
{


    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime")
     * @Assert\DateTime()

     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReservation", type="date", nullable=false)
     */
    private $datereservation;

    /**
     * @var \DateTime
     * @ORM\Column(name="dateFinReservation", type="date", nullable=false)
     */
    private $datefinreservation;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     */
    private $login;

    /**
     * @var \MyApp\UserBundle\Entity\Voiture
     *@ORM\Id
     * @ORM\OneToOne(targetEntity="MyApp\UserBundle\Entity\Voiture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="num_voiture", referencedColumnName="num_voiture", unique=false)
     * })
     */
    private $numVoiture;

    /**
     * @var \MyApp\UserBundle\Entity\User
     *@ORM\Id
     * @ORM\OneToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id", unique=false)
     * })
     */
    private $id;


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
     * @return \DateTime
     */
    public function getDatereservation()
    {
        return $this->datereservation;
    }

    /**
     * @param \DateTime $datereservation
     */
    public function setDatereservation($datereservation)
    {
        $this->datereservation = $datereservation;
    }

    /**
     * @return \DateTime
     */
    public function getDatefinreservation()
    {
        return $this->datefinreservation;
    }

    /**
     * @param \DateTime $datefinreservation
     */
    public function setDatefinreservation($datefinreservation)
    {
        $this->datefinreservation = $datefinreservation;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return Voiture
     */
    public function getNumVoiture()
    {
        return $this->numVoiture;
    }

    /**
     * @param Voiture $numVoiture
     */
    public function setNumVoiture($numVoiture)
    {
        $this->numVoiture = $numVoiture;
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




}

