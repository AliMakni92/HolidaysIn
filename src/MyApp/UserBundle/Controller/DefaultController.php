<?php

namespace MyApp\UserBundle\Controller;

use MyApp\UserBundle\Entity\Voiture;
use MyApp\UserBundle\Entity\ReservationVoiture;

use MyApp\UserBundle\Form\ReservationVoitureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\UserBundle\Entity\User;
use MyApp\UserBundle\Entity\ReservationVoyage;
use MyApp\UserBundle\Entity\VoyageOrganiser;
use MyApp\UserBundle\Form\ReservationVoyageType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $RV= $em->getRepository("MyAppUserBundle:ReservationVoiture")
            ->findnumv();

       $v=new ReservationVoiture();
        foreach($RV as &$v)
        {

            $em = $this->getDoctrine()->getManager();
            $voiture=new Voiture();
            $voiture = $em->getRepository("MyAppUserBundle:Voiture")
                ->find($v->getNumVoiture());
            $voiture->setDisponiblite('1');

            $em->persist($voiture);
            $em->flush();
        }

        $em->getRepository("MyAppUserBundle:ReservationVoiture")
            ->deleterv();


            if ($request->isMethod("post")) {
                $nv = $request->get('nomville');
                $d='1';
                if ($nv != "") {


                    $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                    $voitures = $em
                        ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                        ->findBy(array('nomville' => $nv,'disponiblite'=>$d));

                    return $this->render("MyAppUserBundle:Pages:CarsAccueil.html.twig", array("ms" => $voitures));
                }
                else{
                    $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                    $voitures = $em
                        ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                        ->findAll();//recucperer la liste des modeles de la bd

                    return $this->render("MyAppUserBundle:Pages:CarsAccueil.html.twig", array("ms" => $voitures));
                }
            }



        return $this->render('MyAppUserBundle::layout.html.twig');
    }

    public function profilAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $RV= $em->getRepository("MyAppUserBundle:ReservationVoiture")
            ->findnumv();

        $v=new ReservationVoiture();
        foreach($RV as &$v)
        {

            $em = $this->getDoctrine()->getManager();
            $voiture=new Voiture();
            $voiture = $em->getRepository("MyAppUserBundle:Voiture")
                ->find($v->getNumVoiture());
            $voiture->setDisponiblite('1');

            $em->persist($voiture);
            $em->flush();
        }

        $em->getRepository("MyAppUserBundle:ReservationVoiture")
            ->deleterv();

        $login = $request->get('username');
        return $this->render('MyAppUserBundle:Pages:profile-user.html.twig', array('login' => $login));
    }

    public function AuthAction()
    {
        return $this->render('MyAppUserBundle:Pages:Authentification.html.twig');
    }
    public function pnfAction()
    {
        return $this->render('MyAppUserBundle:Pages:404.html.twig');
    }

    public function carssearchAction(Request $request)
    {

        if ($request->isMethod("post")) {
            $nv = $request->get('nomville');
            $disponiblite='1';
            if ($nv != "") {


                $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                $voitures = $em
                    ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                    ->findBy(array('nomville' => $nv,'disponiblite'=>$disponiblite));
                $login = $request->get('username');
                return $this->render("MyAppUserBundle:Pages:CarsClient.html.twig", array("ms" => $voitures,'username'=>$login));
            }
            else{
                $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                $voitures = $em
                    ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                    ->findBy(array('disponiblite'=>$disponiblite));
                $login = $request->get('username');
                return $this->render("MyAppUserBundle:Pages:CarsClient.html.twig", array("ms" => $voitures,'username'=>$login));
            }

        }
        $login = $request->get('username');
        $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
       $users=new User();
        $disponiblite='1';
        $users = $em
            ->getRepository("MyAppUserBundle:User")//appeler le repo qui a une liaison ave modele
            ->findOneBy(array('username' => $login));//recucperer la liste des modeles de la bd

        $ville=$users->getVille();
        $voitures = $em
            ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
            ->findBy(array('nomville' => $ville,'disponiblite'=>$disponiblite));




        return $this->render("MyAppUserBundle:Pages:CarsClient.html.twig", array("ms" => $voitures,'username'=>$login));

    }



    public function SuperAdminAction(Request $request)
    {
        $login = $request->get('adminadmin');
        return $this->render('MyAppUserBundle:Pages:profile-admin.html.twig', array('login' => $login));

    }


    public function agentAction(Request $request)
    {
        $login = $request->get('adminadmin');
        return $this->render('MyAppUserBundle:Pages:agent.html.twig', array('login' => $login));

    }

    public function afficheUserAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
        $users = $em
            ->getRepository("MyAppUserBundle:User")//appeler le repo qui a une liaison ave modele
            ->findAll();//recucperer la liste des modeles de la bd
        if ($request->isMethod("post")) {
            $username = $request->get('name');
            if ($username != "") {


                $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                $users = $em
                    ->getRepository("MyAppUserBundle:User")//appeler le repo qui a une liaison ave modele
                    ->findBy(array('username' => $username));
                $login = $request->get('adminadmin');
                return $this->render("MyAppUserBundle:Pages:superAdmin.html.twig", array("ms" => $users,'loginAdmin'=>$login));
            }
            else{
                $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                $users = $em
                    ->getRepository("MyAppUserBundle:User")//appeler le repo qui a une liaison ave modele
                    ->findAll();//recucperer la liste des modeles de la bd
            }
        }
        $login = $request->get('adminadmin');
        return $this->render("MyAppUserBundle:Pages:superAdmin.html.twig", array("ms" => $users,'loginAdmin'=>$login));


    }

    public function bloquerAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("MyAppUserBundle:User")
            ->find($id);

            $user->setEtat('0');
            $em->persist($user);
            $em->flush();


            return $this->redirectToRoute("afficher");





    }
    public function debloquerAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("MyAppUserBundle:User")
            ->find($id);


        $user->setEtat('1');
        $em->persist($user);
        $em->flush();


        return $this->redirectToRoute("afficher");





    }
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("MyAppUserBundle:User")
            ->find($id);
        $em->remove($user);
        $em->flush();


        return $this->redirectToRoute("afficher");
    }
    public function voyagesearchAction(Request $request)
    {

        if ($request->isMethod("post")) {
            $nv = $request->get('libelle') ;
            if ($nv != "") {


                $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                $voyageorganiser = $em
                    ->getRepository("MyAppUserBundle:VoyageOrganiser")//appeler le repo qui a une liaison ave modele
                    ->findBy(array('libelle' => $nv));
                $login = $request->get('username');
                return $this->render("MyAppUserBundle:Pages:VoyageClient.html.twig", array("ms" => $voyageorganiser,'username'=>$login));
            }


        }
        $login = $request->get('username');
        $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
        $users=new User();
        $users = $em
            ->getRepository("MyAppUserBundle:User")//appeler le repo qui a une liaison ave modele
            ->findOneBy(array('username' => $login));//recucperer la liste des modeles de la bd

        $voyageorganiser = $em
            ->getRepository("MyAppUserBundle:VoyageOrganiser")//appeler le repo qui a une liaison ave modele
            ->findAll();




        return $this->render("MyAppUserBundle:Pages:VoyageClient.html.twig", array("ms" => $voyageorganiser,'username'=>$login));

    }


}