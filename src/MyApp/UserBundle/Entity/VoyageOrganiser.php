<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoyageOrganiser
 *
 * @ORM\Table(name="voyage_organiser", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class VoyageOrganiser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_voyage", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVoyage;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=254, nullable=true)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree", type="integer", nullable=false)
     */
    private $duree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_de_depart", type="date", nullable=false)
     */
    private $dateDeDepart;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_places_dispo", type="integer", nullable=false)
     */
    private $nbrePlacesDispo;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_par_personne", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixParPersonne;

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
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255  ,nullable=false)
     *
     *               )
     *
     */
    private $photo;

    /**
     * @return int
     */
    public function getIdVoyage()
    {
        return $this->idVoyage;
    }

    /**
     * @param int $idVoyage
     */
    public function setIdVoyage($idVoyage)
    {
        $this->idVoyage = $idVoyage;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return int
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param int $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return \DateTime
     */
    public function getDateDeDepart()
    {
        return $this->dateDeDepart;
    }

    /**
     * @param \DateTime $dateDeDepart
     */
    public function setDateDeDepart($dateDeDepart)
    {
        $this->dateDeDepart = $dateDeDepart;
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
    public function getPrixParPersonne()
    {
        return $this->prixParPersonne;
    }

    /**
     * @param float $prixParPersonne
     */
    public function setPrixParPersonne($prixParPersonne)
    {
        $this->prixParPersonne = $prixParPersonne;
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
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }


}

