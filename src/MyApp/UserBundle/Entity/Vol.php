<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vol
 *
 * @ORM\Table(name="vol", indexes={@ORM\Index(name="FK_VOL_ASSOCIATI_ADMIN", columns={"id"})})
 * @ORM\Entity
 */
class Vol
{
    /**
     * @var integer
     *
     * @ORM\Column(name="num_vol", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numVol;

    /**
     * @var string
     *
     * @ORM\Column(name="compagnie_aerienne", type="string", length=50, nullable=false)
     */
    private $compagnieAerienne;

    /**
     * @var string
     *
     * @ORM\Column(name="aeroport_depart", type="string", length=50, nullable=false)
     */
    private $aeroportDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="aeroport_arrivee", type="string", length=50, nullable=true)
     */
    private $aeroportArrivee;

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type ='1';

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
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
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
    private $id;

    /**
     * @return int
     */
    public function getNumVol()
    {
        return $this->numVol;
    }

    /**
     * @param int $numVol
     */
    public function setNumVol($numVol)
    {
        $this->numVol = $numVol;
    }

    /**
     * @return string
     */
    public function getCompagnieAerienne()
    {
        return $this->compagnieAerienne;
    }

    /**
     * @param string $compagnieAerienne
     */
    public function setCompagnieAerienne($compagnieAerienne)
    {
        $this->compagnieAerienne = $compagnieAerienne;
    }

    /**
     * @return string
     */
    public function getAeroportDepart()
    {
        return $this->aeroportDepart;
    }

    /**
     * @param string $aeroportDepart
     */
    public function setAeroportDepart($aeroportDepart)
    {
        $this->aeroportDepart = $aeroportDepart;
    }

    /**
     * @return string
     */
    public function getAeroportArrivee()
    {
        return $this->aeroportArrivee;
    }

    /**
     * @param string $aeroportArrivee
     */
    public function setAeroportArrivee($aeroportArrivee)
    {
        $this->aeroportArrivee = $aeroportArrivee;
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
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
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

