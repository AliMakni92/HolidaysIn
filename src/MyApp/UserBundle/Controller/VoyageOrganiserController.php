<?php

namespace MyApp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\UserBundle\Form\VoyageOrganiserType;
use MyApp\UserBundle\Entity\VoyageOrganiser;
use MyApp\UserBundle\Entity\ReservationVoyage;
use MyApp\UserBundle\Form\ReservationVoyageType;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateTimeType;

use Doctrine\DBAL\Platforms\AbstractPlatform;


class VoyageOrganiserController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function addVoyageOrganiserAction(Request $request)
    {


        $voyageorganiser = new Voyageorganiser();
        $form = $this->createForm(VoyageOrganiserType::class, $voyageorganiser);


        $form->handleRequest($request);
        if ($form->isValid()) {
            $date = new \DateTime('Europe/Madrid');

            if ($voyageorganiser->getDateDeDepart() < $date) {
                echo "<script>alert(\"Vous devez choisir une date supèrieur à la date courante : \")
                </script>";

            } else {
                if ($voyageorganiser->getDuree() < 0 || $voyageorganiser->getNbrePlacesDispo() < 0 || $voyageorganiser->getPrixParPersonne() < 0) {
                    echo "<script>alert(\"Vous devez choisir un entier strictement positif : \")
                </script>";

                } else {
                    $login = $request->get('adminadmin');

                    $em = $this->getDoctrine()->getManager();
                    $user = $em
                        ->getRepository("MyAppUserBundle:User")
                        ->findOneBy(array('username' => $login));
                    $libelle = $voyageorganiser->getLibelle();
                    $v = $em
                        ->getRepository("MyAppUserBundle:VoyageOrganiser")
                        ->findOneBy(array('libelle' => $libelle));
                    if ($v == Null) {

                        $voyageorganiser->setId($user);
                        $em->persist($voyageorganiser);
                        $em->flush();


                        $voyageorganiser = $em
                            ->getRepository("MyAppUserBundle:VoyageOrganiser")//appeler le repo qui a une liaison ave modele
                            ->findAll();
                        $login = $request->get('adminadmin');
                        return $this->render("MyAppUserBundle:Pages:VoyageOrganiser.html.twig", array("ms" => $voyageorganiser, 'loginAdmin' => $login));
                    } else {
                        $login = $request->get('adminadmin');
                        $alerte = " avec libelle inexistant";
                        return $this->render("MyAppUserBundle:Pages:addVoyageOrganiser.html.twig", array("f" => $form->createView(), 'loginAdmin' => $login, 'alerte' => $alerte));

                    }
                }
            }
        }
        $login = $request->get('adminadmin');
        $alerte = "";

        return $this->render("MyAppUserBundle:Pages:addVoyageOrganiser.html.twig", array("f" => $form->createView(), 'loginAdmin' => $login, 'alerte' => $alerte));

    }


    public function afficheVoyageOrganiserAction(Request $request)
    {
        if ($request->isMethod("post")) {
            $nv = $request->get('libelle');




            $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
            $voyageorganiser = $em
                ->getRepository("MyAppUserBundle:VoyageOrganiser")//appeler le repo qui a une liaison ave modele
                ->findBy(array('libelle' => $nv));
            $login = $request->get('adminadmin');
            return $this->render("MyAppUserBundle:Pages:VoyageOrganiser.html.twig", array("ms" => $voyageorganiser, 'loginAdmin' => $login));


        }
        $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
        $voyageorganiser = $em
            ->getRepository("MyAppUserBundle:VoyageOrganiser")//appeler le repo qui a une liaison ave modele
            ->findAll();//recucperer la liste des modeles de la bd

        $login = $request->get('adminadmin');

        return $this->render("MyAppUserBundle:Pages:VoyageOrganiser.html.twig", array("ms" => $voyageorganiser, 'loginAdmin' => $login));


    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $voyageorganiser = $em->getRepository("MyAppUserBundle:VoyageOrganiser")
            ->find($id);
        $em->remove($voyageorganiser);
        $em->flush();


        return $this->redirectToRoute("afficherVoyageOrganiser");
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $voyageorganiser = $em->getRepository("MyAppUserBundle:VoyageOrganiser")
            ->find($id);
        $form = $this->createForm(VoyageOrganiserType::class, $voyageorganiser);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($voyageorganiser);
            $em->flush();
            return $this->redirectToRoute("afficherVoyageOrganiser");



        }
        $login = $request->get('adminadmin');
        return $this->render("MyAppUserBundle:Pages:update.html.twig", array("f" => $form->createView(),'loginAdmin'=>$login));


    }










    public function ReserverAction(Request $request)
    {
        $ReservationVoyage=new ReservationVoyage();

        $form=$this->createform(ReservationVoyageType::class,$ReservationVoyage);
        $form->handleRequest($request);
        $login = $request->get('username');
        $libelle = $request->get('libelle');
        $duree = $request->get('duree');
        $photo = $request->get('photo');
        $dateDeDepart = $request->get('dateDeDepart');
        $prixParPersonne = $request->get('prixParPersonne');
        $nbrePlacesDispo = $request->get('nbrePlacesDispo');
        $idVoyage=$request->get('idVoyage');
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted()) {
            $date = new \DateTime('Europe/Madrid');


            $ReservationVoyage->setDate($date);

            $ReservationVoyage->setLogin($login);
            $user = $em
                ->getRepository("MyAppUserBundle:User")
                ->findOneBy(array('username' => $login));
            $ReservationVoyage->setId($user);
            $voyageorganiser = new VoyageOrganiser();
            $voyageorganiser = $em
                ->getRepository("MyAppUserBundle:VoyageOrganiser")
                ->findOneBy(array('idVoyage' => $idVoyage));
            $ReservationVoyage->setIdVoyage($voyageorganiser);
            //$voyageorganiser->setDisponiblite('0');
            $nbr = $ReservationVoyage->getNbrPersonnes();
            $n = $voyageorganiser->getNbrePlacesDispo();
            $ns = $n - $nbr;
            if (($ns < 0) || ($nbr<0) ){
                echo "<script>alert(\"le nombres de places reserve et doit etre superieur et doit etre inferieur ou egal au nombre de places disponibles :$n \")
                </script>";
            } else {

                $voyageorganiser->setNbrePlacesDispo($ns);
                echo "<script>alert(\"reservation faite avec succées\")
                </script>";

                $em->persist($ReservationVoyage);
                $em->persist($voyageorganiser);
                $em->flush();
            }
        }



        return $this->render('MyAppUserBundle:Pages:VoyageClientDetail.html.twig', array('username' => $login,'libelle'=>$libelle,'duree'=>$duree,'photo'=>$photo,'dateDeDepart'=>$dateDeDepart,'prixParPersonne'=>$prixParPersonne,'nbrePlacesDispo'=>$nbrePlacesDispo,"f"=>$form->createView()));

    }


    public function cherchervoyageAction(Request $request)
    {
        if ($request->isMethod("post")) {
            $nv = $request->get('libelle');
            if ($nv != "") {


                $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                $voyageorganiser = $em
                    ->getRepository("MyAppUserBundle:VoyageOrganiser")//appeler le repo qui a une liaison ave modele
                    ->findBy(array('libelle' => $nv));

                return $this->render("MyAppUserBundle:Pages:VoyageAccueil.html.twig", array("ms" => $voyageorganiser));
            }
            else{
                $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                $voyageorganiser = $em
                    ->getRepository("MyAppUserBundle:VoyageOrganiser")//appeler le repo qui a une liaison ave modele
                    ->findAll();//recucperer la liste des modeles de la bd

                return $this->render("MyAppUserBundle:Pages:VoyageAccueil.html.twig", array("ms" => $voyageorganiser));
            }
        }


    }
    public function mediaAction() {
        $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
        $voyageorganiser = $em
            ->getRepository("MyAppUserBundle:VoyageOrganiser");
        return $this->render("MyAppUserBundle:Pages:VoyageMedia.html.twig");
    }

    public function listReservationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager(); //gestionnaire des entites c lui qui gere le crud
        $login = $request->get('username');
        $modeles = $em->getRepository("MyAppUserBundle:Navire")->findAll();
        $reservation = $em->getRepository("MyAppUserBundle:ReservationVoyage")->findAll();
        return $this->render("MyAppUserBundle:Pages:VoyageReservation.html.twig", array("ms" => $modeles, 'username' => $login, 'reservation' => $reservation));
    }

}