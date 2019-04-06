<?php
namespace MyApp\UserBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 16/11/2016
 * Time: 22:01
 */
/**
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string",length=255)
     *
     */
    protected $nom;
    /**
     * @ORM\Column(type="string",length=255)
     */
    protected $prenom;
    /**
     * @ORM\Column(type="string",length=255)
     */
    protected $nationalite;
    /**
     * @ORM\Column(type="string",length=255)
     */
    protected $ville;


    /**
     * @ORM\Column(type="boolean")
     */

    protected $etat= '1';

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * @param mixed $nationalite
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }


   public function getParent()
    {
        return 'FOSUserBundle';
    }
    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getNom();
    }






}