<?php

namespace MyApp\UserBundle\Controller;
use MyApp\UserBundle\Entity\ReservationNavire;
use Ob\HighchartsBundle\Highcharts\Highchart;

use Symfony\Component\HttpFoundation\Request ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\UserBundle\Entity\Navire;
use MyApp\UserBundle\Form\NavireType;
use MyApp\UserBundle\Entity\User;



class NavireController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager(); //gestionnaire des entites c lui qui gere le crud
        $modeles = $em->getRepository("MyAppUserBundle:Navire")
            ->findAll(); //nous permettre de stocker et séparer les appels en BDD

        return $this->render("MyAppUserBundle:Navire:list.html.twig", array("ms" => $modeles));
    }

    public function listClientAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager(); //gestionnaire des entites c lui qui gere le crud
        $login = $request->get('username');   //recuperer le login de username de la page admin
        $modeles = $em->getRepository("MyAppUserBundle:Navire")
            ->findAll();

        return $this->render("MyAppUserBundle:Navire:navireClient.html.twig", array("ms" => $modeles, 'username' => $login));
    }

    public function addAction(Request $request)
    {

//
        if ($request->isMethod("post")) {

            $compagnieNavale = $request->get('compagnie');
            $villeDepart = $request->get('villed');
            $villeArrivee = $request->get('villea');
            $dateDepart = $request->get('dated');
            $dateArrivee = $request->get('datea');
            $nbrePlacesDispo = $request->get('nbr');
            $prix = $request->get('pr');


            $modele = new Navire();
            $modele->setCompagnieNavale($compagnieNavale);
            $modele->setVilleDepart($villeDepart);
            $modele->setVilleArrivee($villeArrivee);
            $modele->setDateDepart($dateDepart);
            $modele->setDateArrivee($dateArrivee);
            $modele->setNbrePlacesDispo($nbrePlacesDispo);
            $modele->setPrix($prix);
            $em = $this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush();
            return $this->redirectToRoute("esprit_modele_list");
        }
        return $this->render("MyAppUserBundle:Navire:add.html.twig");
    }

    public function add2Action(Request $request)
    {


        $modele = new Navire();
        $form = $this->createForm(NavireType::class, $modele);
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($modele->getDateDepart() > $modele->getDateArrivee()) {
                echo "<script>alert(\"date depart doit etre avant la date d'arrivee \")
                </script>";
            } else {

                $em = $this->getDoctrine()->getManager();
                $em->persist($modele);
                $em->flush();
                return $this->redirectToRoute("esprit_modele_list");
            }

        }
        return $this->render("MyAppUserBundle:navire:add.html.twig", array("f" => $form->createView()));

    }

    public function deleteAction($idNavire)
    {
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository("MyAppUserBundle:Navire")//repertoire en liaison avec modele ,nous permettre de stocker et séparer les appels en BDD
            ->find($idNavire);
        $em->remove($modele);
        $em->flush();
        return $this->redirectToRoute("esprit_modele_list");

    }

    public function updateAction(Request $request, $idNavire)
    {
        $em = $this->getDoctrine()->getManager(); // gestionnaire des entités qui gere le crud
        $modele = $em->getRepository("MyAppUserBundle:Navire")
        ->find($idNavire);                         //repertoire en liaison avec modele ,nous permettre de stocker et séparer les appels en BDD
        $form = $this->createForm(NavireType::class, $modele);
        $form->handleRequest($request);
        if ($form->isValid()) {       //tout les champs sont remplis et securité contre hack
            $em->persist($modele);     // exist un objet modele a mettre dans la base
            $em->flush();               // execute la requette
            return $this->redirectToRoute("esprit_modele_list");     //prend en parametre le nom de la route dans routing.yml

        }
        return $this->render("MyAppUserBundle:navire:update.html.twig", array("f" => $form->createView()));  //dessiner le formulaure par createview

    }

    public function rechercheAction(Request $request)
    {

        if ($request->isMethod("post")) {
            $compagnieNavale = $request->get('compagnie');


            $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
            $modeles = $em
                ->getRepository("MyAppUserBundle:Navire")//appeler le repo qui a une liaison ave navire
                ->findBy(array('compagnieNavale' => $compagnieNavale));
            return $this->render("MyAppUserBundle:Navire:list.html.twig", array("ms" => $modeles));
        }
        return $this->render("MyAppUserBundle:Navire:recherche.html.twig", array());


    }

    public function ReserverAction(Request $request)
    {

        $login = $request->get('username');
        $compagnieNavale = $request->get('compagnieNavale');
        $villeDepart = $request->get('villeDepart');
        $villeArrivee = $request->get('villeArrivee');
        $dateDepart = $request->get('dateDepart');
        $dateArrivee = $request->get('dateArrivee');
        $nbrePlacesDispo = $request->get('nbrePlacesDispo');
        $prix = $request->get('prix');


        if ($request->isMethod("post")) {
            $ReservationNavire = new ReservationNavire();
            $idNavire = $request->get('idNavire');
            $em = $this->getDoctrine()->getManager();
            $nav = new Navire();

            $nav = $em
                ->getRepository("MyAppUserBundle:Navire")
                ->find($idNavire);
            $login = $request->get('username');
            $em = $this->getDoctrine()->getManager();
            $user = new User();
            $user = $em
                ->getRepository("MyAppUserBundle:User")
                ->findOneBy(array('username' => $login));
            $ReservationNavire->setId($user);
            $ReservationNavire->setIdNavire($nav);
            $date = new \DateTime();


            $ReservationNavire->setDate(new \DateTime());
            $n = $request->get('n');
            $nbr = $nav->getNbrePlacesDispo();

            $np = $nbr - $n;
            if ($np < 0) {
                echo "<script>alert(\"le nbr de places ne doit pas etre superieur a: $nbr \")
                </script>";

            } else {
                $nav->setNbrePlacesDispo($np);
                $ReservationNavire->setNombrePersonne($n);

                $em->persist($ReservationNavire);   //exist un objet reservationnavire a mettre dans la base
                $em->persist($nav);

                $em->flush();    //executer la requette


                echo "<script>alert(\"Reservation reussi : \")
                </script>";
            }

        }




        return $this->render('MyAppUserBundle:navire:detail.html.twig',
            array('username' => $login, 'compagnieNavale' => $compagnieNavale, 'villeDepart' => $villeDepart,
                'villeArrivee' => $villeArrivee, 'dateDepart' => $dateDepart,
                'dateArrivee' => $dateArrivee, 'nbrePlacesDispo' => $nbrePlacesDispo, 'prix' => $prix));

    }


    public function listReservationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager(); //gestionnaire des entites c lui qui gere le crud
        $login = $request->get('username');
        $modeles = $em->getRepository("MyAppUserBundle:Navire")->findAll();
        $reservation = $em->getRepository("MyAppUserBundle:ReservationNavire")->findAll();

        return $this->render("MyAppUserBundle:Navire:listReservation.html.twig", array("ms" => $modeles, 'username' => $login, 'reservation' => $reservation));
    }

    public function deleteReservationAction(Request $request)
    {
        $id=$request->get('id');
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository("MyAppUserBundle:Navire")->find($id);
        $em->remove($modele); //existe un objet modele a supprimer
        $em->flush();     //executer la suppression
        return $this->redirectToRoute("list_Reservation");

    }


    public function grapheAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        //$em = $this->getDoctrine()->getManager();
        $navire = $em->getRepository("MyAppUserBundle:Navire")->findAll();
        $tab = array();
        $categories = array();
        foreach ($navire as $navire) {
            array_push($tab, $navire->getPrix());
            array_push($categories, $navire->getCompagnieNavale());
        }

        // Chart
        $series = array(array("name" => "prix", "data" => $tab));
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        //  #id du div où afficher le graphe
        $ob->title->text('prix par compagnie navale');
        $ob->xAxis->title(array('text' => "compagnie navale"));
        $ob->yAxis->title(array('text' => "prix"));
        $ob->xAxis->categories($categories);
        $ob->series($series);

        return $this->render('MyAppUserBundle:navire:graphe.html.twig', array('chart' => $ob));
    }
}