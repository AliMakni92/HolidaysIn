<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 29/11/2016
 * Time: 00:11
 */

namespace MyApp\UserBundle\Entity;
use Doctrine\ORM\EntityRepository;



class ReservationVoitureRepository extends EntityRepository
{
   /* public function findPaysQB()
    {
        $qb=$this->createQueryBuilder('s');
        $qb->where('s.pays=:p');
        $qb->setParameter('p',"tunis");
        return $qb->getQuery()->getResult();
    }*/
   public function findnumv()
   {
       $em=$this->getEntityManager();
       $d= new \DateTime();


       $query=$em->createQuery("select v from MyAppUserBundle:ReservationVoiture v WHERE v.datefinreservation<=:t ")->setParameter('t', $d);

       return $query->getResult();



   }
    public function deleterv()
    {
        $em=$this->getEntityManager();
       $d= new \DateTime();


        $query=$em->createQuery("delete from MyAppUserBundle:ReservationVoiture v WHERE v.datefinreservation<=:t ")->setParameter('t', $d);

        return $query->getResult();
    }


}