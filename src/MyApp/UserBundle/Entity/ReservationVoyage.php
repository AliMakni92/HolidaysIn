<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationVoyage
 *
 * @ORM\Table(name="reservation_voyage", indexes={@ORM\Index(name="FK_RESERVAT_ASSOCIATI_VOYAGEOR", columns={"id_voyage"}), @ORM\Index(name="FK_RESERVAT_ASSOCIATI_UTILISAT", columns={"id"})})
 * @ORM\Entity
 */
class ReservationVoyage
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
     * @var \MyApp\UserBundle\Entity\VoyageOrganiser
     *@ORM\Id
     * @ORM\OneToOne(targetEntity="MyApp\UserBundle\Entity\VoyageOrganiser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_voyage", referencedColumnName="id_voyage", unique=false)
     * })
     */
    private $idVoyage;

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
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     */
    private $login;
    /**
     * @var integer
     *@ORM\Id
     * @ORM\Column(name="nbrpersonnes", type="integer", nullable=false)
     */
    private $nbrPersonnes;

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
     * @return VoyageOrganiser
     */
    public function getIdVoyage()
    {
        return $this->idVoyage;
    }

    /**
     * @param VoyageOrganiser $idVoyage
     */
    public function setIdVoyage($idVoyage)
    {
        $this->idVoyage = $idVoyage;
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
     * @return int
     */
    public function getNbrPersonnes()
    {
        return $this->nbrPersonnes;
    }

    /**
     * @param int $nbrPersonnes
     */
    public function setNbrPersonnes($nbrPersonnes)
    {
        $this->nbrPersonnes = $nbrPersonnes;
    }


}

