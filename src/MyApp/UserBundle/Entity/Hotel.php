<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 * @ORM\Table(name="hotel", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Hotel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_hotel", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHotel;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=254, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=254, nullable=true)
     */
    private $ville;

    /**
     * @var integer
     *
     * @ORM\Column(name="etoile", type="integer", nullable=false)
     */
    private $etoile;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_chambre", type="integer", nullable=false)
     */
    private $nbreChambre;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_par_nuit", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixParNuit;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="blob", nullable=false)
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


}

