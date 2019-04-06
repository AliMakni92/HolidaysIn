<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationHotel
 *
 * @ORM\Table(name="reservation_hotel", indexes={@ORM\Index(name="FK_RESERVAT_ASSOCIATI_UTILISAT", columns={"id"}), @ORM\Index(name="FK_RESERVAT_ASSOCIATI_HOTEL", columns={"id_hotel"})})
 * @ORM\Entity
 */
class ReservationHotel
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_de_nuit", type="integer", nullable=false)
     */
    private $nbreDeNuit;

    /**
     * @var \MyApp\UserBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id", unique=true)
     * })
     */
    private $id;

    /**
     * @var \MyApp\UserBundle\Entity\Hotel
     *
     * @ORM\OneToOne(targetEntity="MyApp\UserBundle\Entity\Hotel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_hotel", referencedColumnName="id_hotel", unique=true)
     * })
     */
    private $idHotel;


}

