<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Voiture
{
    /**
     * @var integer
     *
     * @ORM\Column(name="num_voiture", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $numVoiture;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=50, nullable=false)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255, nullable=false)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="puissance", type="string", length=50, nullable=false)
     */
    private $puissance;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=50, nullable=false)
     */
    private $couleur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disponiblite", type="boolean", nullable=false)
     */
    private $disponiblite = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="NomVille", type="string", length=50, nullable=false)
     */
    private $nomville;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_par_jour", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixParJour;
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
    public function getNumVoiture()
    {
        return $this->numVoiture;
    }

    /**
     * @param int $numVoiture
     */
    public function setNumVoiture($numVoiture)
    {
        $this->numVoiture = $numVoiture;
    }

    /**
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * @param string $matricule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    /**
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @param string $marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    /**
     * @return string
     */
    public function getPuissance()
    {
        return $this->puissance;
    }

    /**
     * @param string $puissance
     */
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;
    }

    /**
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param string $couleur
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }

    /**
     * @return boolean
     */
    public function isDisponiblite()
    {
        return $this->disponiblite;
    }

    /**
     * @param boolean $disponiblite
     */
    public function setDisponiblite($disponiblite)
    {
        $this->disponiblite = $disponiblite;
    }

    /**
     * @return string
     */
    public function getNomville()
    {
        return $this->nomville;
    }

    /**
     * @param string $nomville
     */
    public function setNomville($nomville)
    {
        $this->nomville = $nomville;
    }

    /**
     * @return float
     */
    public function getPrixParJour()
    {
        return $this->prixParJour;
    }

    /**
     * @param float $prixParJour
     */
    public function setPrixParJour($prixParJour)
    {
        $this->prixParJour = $prixParJour;
    }

    /**
     * @return User
     *
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

