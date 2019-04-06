<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Navire
 *
 * @ORM\Table(name="navire", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Navire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_navire", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNavire;

    /**
     * @var string
     *
     * @ORM\Column(name="compagnie_navale", type="string", length=255, nullable=false)
     */
    private $compagnieNavale;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_depart", type="string", length=255, nullable=false)
     */
    private $villeDepart;


    /**
     * @var string
     *
     * @ORM\Column(name="ville_arrivee", type="string", length=255, nullable=false)
     */
    private $villeArrivee;

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_depart", type="date", nullable=false)
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_arrivee", type="date", nullable=false)
     */
    private $dateArrivee;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_places_dispo", type="integer", nullable=false)
     */
    private $nbrePlacesDispo;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var \MyApp\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $idAdmin;

    /**
     * @return int
     */
    public function getIdNavire()
    {
        return $this->idNavire;
    }

    /**
     * @param int $idNavire
     */
    public function setIdNavire($idNavire)
    {
        $this->idNavire = $idNavire;
    }

    /**
     * @return string
     */
    public function getCompagnieNavale()
    {
        return $this->compagnieNavale;
    }

    /**
     * @param string $compagnieNavale
     */
    public function setCompagnieNavale($compagnieNavale)
    {
        $this->compagnieNavale = $compagnieNavale;
    }

    /**
     * @return string
     */
    public function getVilleDepart()
    {
        return $this->villeDepart;
    }

    /**
     * @return string
     */
    public function getVilleArrivee()
    {
        return $this->villeArrivee;
    }

    /**
     * @param string $villeArrivee
     */
    public function setVilleArrivee($villeArrivee)
    {
        $this->villeArrivee = $villeArrivee;
    }

    /**
     * @return boolean
     */
    public function isType()
    {
        return $this->type;
    }

    /**
     * @param boolean $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * @param \DateTime $dateDepart
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;
    }

    /**
     * @return \DateTime
     */
    public function getDateArrivee()
    {
        return $this->dateArrivee;
    }

    /**
     * @param \DateTime $dateArrivee
     */
    public function setDateArrivee($dateArrivee)
    {
        $this->dateArrivee = $dateArrivee;
    }

    /**
     * @return int
     */
    public function getNbrePlacesDispo()
    {
        return $this->nbrePlacesDispo;
    }

    /**
     * @param int $nbrePlacesDispo
     */
    public function setNbrePlacesDispo($nbrePlacesDispo)
    {
        $this->nbrePlacesDispo = $nbrePlacesDispo;
    }

    /**
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return User
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    /**
     * @param User $idAdmin
     */
    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;
    }

    /**
     * @param string $villeDepart
     */
    public function setVilleDepart($villeDepart)
    {
        $this->villeDepart = $villeDepart;
    }
}

