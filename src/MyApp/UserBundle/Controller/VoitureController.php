<?php

namespace MyApp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use MyApp\UserBundle\Form\VoitureType;
use MyApp\UserBundle\Entity\Voiture;
use MyApp\UserBundle\Entity\ReservationVoiture;
use MyApp\UserBundle\Form\ReservationVoitureType;
use MyApp\UserBundle\Entity\Mail;
use MyApp\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;


use MyApp\UserBundle\Form\MailType;
use Swift_Message;




class VoitureController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function addVoitureAction(Request $request)
    {



        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);


        $form->handleRequest($request);
        if ($form->isSubmitted())
        {

            $login = $request->get('adminadmin');

            $em = $this->getDoctrine()->getManager();
            $user = $em
                ->getRepository("MyAppUserBundle:User")
                ->findOneBy(array('username' => $login));
            $matricule=$voiture->getMatricule();
            $v = $em
                ->getRepository("MyAppUserBundle:Voiture")
                ->findOneBy(array('matricule' => $matricule));
            if($v==Null) {

                $voiture->setId($user);
                $em->persist($voiture);
                $em->flush();




                $voitures = $em
                    ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                    ->findAll();
                $login = $request->get('adminadmin');
                return $this->render("MyAppUserBundle:Pages:Cars1.html.twig", array("ms" => $voitures,'loginAdmin'=>$login));
            }
            else{
                $login = $request->get('adminadmin');
                $alerte=" avec Matricule inexistant";
                echo "<script>alert(\"Matricule existant : \")
                </script>";


                return $this->render("MyAppUserBundle:Pages:addCars.html.twig",array("f" => $form->createView(),'loginAdmin'=>$login,'alerte'=>$alerte));

            }
        }
        $login = $request->get('adminadmin');
        $alerte="";

        return $this->render("MyAppUserBundle:Pages:addCars.html.twig", array("f" => $form->createView(),'loginAdmin'=>$login,'alerte'=>$alerte));

    }
    public function afficheVoitureAction(Request $request)
    {
       if ($request->isMethod("post")) {
            $nv = $request->get('nomville');
           $m=$request->get('marque');
           $n=$request->get('c');

            if ($nv != "" &&$m=="" && $n=="") {


                $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                $voitures = $em
                    ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                    ->findBy(array('nomville' => $nv));
                $login = $request->get('adminadmin');
                return $this->render("MyAppUserBundle:Pages:Cars1.html.twig", array("ms" => $voitures,'loginAdmin'=>$login));
            }
           if($nv == "" &&$m==""&& $n=="" )
           {
                $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                $voitures = $em
                    ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                    ->findAll();//recucperer la liste des modeles de la bd
                $login = $request->get('adminadmin');
                return $this->render("MyAppUserBundle:Pages:Cars1.html.twig", array("ms" => $voitures,'loginAdmin'=>$login));
            }
           if($nv == "" &&$m!="" &&$n=="")
           {
               $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
               $voitures = $em
                   ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                   ->findBy(array('marque' => $m));
               $login = $request->get('adminadmin');
               return $this->render("MyAppUserBundle:Pages:Cars1.html.twig", array("ms" => $voitures,'loginAdmin'=>$login));
           }
           if($nv != "" &&$m!="" &&$n=="")
           {
               $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
               $voitures = $em
                   ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                   ->findBy(array('marque' => $m,'nomville' => $nv));
               $login = $request->get('adminadmin');
               return $this->render("MyAppUserBundle:Pages:Cars1.html.twig", array("ms" => $voitures,'loginAdmin'=>$login));
           }
           if($nv != "" &&$m!="" &&$n!="")
           {
               $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
               $voitures = $em
                   ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                   ->findBy(array('marque' => $m,'nomville' => $nv,'couleur'=>$n));
               $login = $request->get('adminadmin');
               return $this->render("MyAppUserBundle:Pages:Cars1.html.twig", array("ms" => $voitures,'loginAdmin'=>$login));
           }
           if($nv == "" &&$m=="" &&$n!="")
           {
               $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
               $voitures = $em
                   ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                   ->findBy(array('couleur'=>$n));
               $login = $request->get('adminadmin');
               return $this->render("MyAppUserBundle:Pages:Cars1.html.twig", array("ms" => $voitures,'loginAdmin'=>$login));
           }  if($nv == "" &&$m!="" &&$n!="")
           {
               $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
               $voitures = $em
                   ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                   ->findBy(array('marque'=>$m,'couleur'=>$n));
               $login = $request->get('adminadmin');
               return $this->render("MyAppUserBundle:Pages:Cars1.html.twig", array("ms" => $voitures,'loginAdmin'=>$login));
           }
           if($nv != "" &&$m=="" &&$n!="")
           {
               $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
               $voitures = $em
                   ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                   ->findBy(array('nomville'=>$nv,'couleur'=>$n));
               $login = $request->get('adminadmin');
               return $this->render("MyAppUserBundle:Pages:Cars1.html.twig", array("ms" => $voitures,'loginAdmin'=>$login));
           }




        }
        $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
        $voitures = $em
            ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
            ->findAll();//recucperer la liste des modeles de la bd

        $login = $request->get('adminadmin');

        return $this->render("MyAppUserBundle:Pages:Cars1.html.twig", array("ms" => $voitures,'loginAdmin'=>$login));


    }
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $voiture = $em->getRepository("MyAppUserBundle:Voiture")
            ->find($id);
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute("afficherVoiture");



        }
        $login = $request->get('adminadmin');
        return $this->render("MyAppUserBundle:Pages:updateVoiture.html.twig", array("f" => $form->createView(),'loginAdmin'=>$login));


    }
    public function ReserverAction(Request $request)
    {
        $ReservationVoiture=new ReservationVoiture();
        $mail = new Mail();


        $form=$this->createform(ReservationVoitureType::class,$ReservationVoiture);
        $form->handleRequest($request);
        $login = $request->get('username');
        $marque = $request->get('marque');
        $nomville = $request->get('nomville');
        $photo = $request->get('photo');
        $prix = $request->get('prix');
        $numVoiture=$request->get('numVoiture');
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted()) {
            $date = new \DateTime('Europe/Madrid');


            if ($ReservationVoiture->getDatereservation() < $date || $ReservationVoiture->getDatereservation()>=$ReservationVoiture->getDateFinreservation()) {
                echo "<script>alert(\"Vous avez choisi une date errone  \")
                </script>";
            } else {



            $ReservationVoiture->setDate($date);

            $ReservationVoiture->setLogin($login);
            $user = new User();

            $user = $em
                ->getRepository("MyAppUserBundle:User")
                ->findOneBy(array('username' => $login));
            $email = $user->getEmail();

            $ReservationVoiture->setId($user);

            $voiture = new Voiture();
            $voiture = $em
                ->getRepository("MyAppUserBundle:Voiture")
                ->findOneBy(array('numVoiture' => $numVoiture));
            if ($voiture->isDisponiblite() == '0') {
                echo "<script>alert(\"Vous avez deja reservé la voiture consultez votre boite Mail : \")
                </script>";

            } else {
                $ReservationVoiture->setNumVoiture($voiture);
                $voiture->setDisponiblite('0');


                $em->persist($ReservationVoiture);
                $em->persist($voiture);
                $datetime1=$ReservationVoiture->getDatereservation();
                $datetime2=$ReservationVoiture->getDateFinreservation();
                $interval = $datetime1->diff($datetime2);
                $days=$interval->format('%a days');
                $p=$voiture->getPrixParJour();
                $prixR=$p*$days;
                $em->flush();
                echo "<script>alert(\"Reservation reussi consultez votre boite mail\ le prix totale est :$prixR \")
                </script>";


                $message = \Swift_Message::newInstance()
                    ->setSubject('Esprit Travel')
                    ->setFrom('espritplus2016@gmail.com')
                    ->setTo($email)
                    ->setBody($this->renderView(
                        'MyAppUserBundle:Mail:mail.html.twig',
                        array('nom' => $user->getNom(), 'prenom' => $user->getPrenom(),'prix'=>$prixR)
                    ),
                        'text/html');
                $this->get('mailer')->send($message);
                $alerte="Reservation reussi vous devez payer  ".$prixR;
                return $this->render('MyAppUserBundle:Pages:CarsClientDetail.html.twig', array('username' => $login,'marque'=>$marque,'nomville'=>$nomville,'photo'=>$photo,'prix'=>$prix,'alerte'=>$alerte,"f"=>$form->createView()));


            }
        }


        }

$alerte="";

        return $this->render('MyAppUserBundle:Pages:CarsClientDetail.html.twig', array('username' => $login,'marque'=>$marque,'nomville'=>$nomville,'photo'=>$photo,'prix'=>$prix,'alerte'=>$alerte,"f"=>$form->createView()));

    }

   public function deleteAction($id)
   {
       $em = $this->getDoctrine()->getManager();
       $voiture = $em->getRepository("MyAppUserBundle:Voiture")
           ->find($id);
       $em->remove($voiture);
       $em->flush();



       return $this->redirectToRoute("afficherVoiture");

   }
   public function cherchervoitureAction(Request $request)
   {
       if ($request->isMethod("post")) {
           $nv = $request->get('nomville');
           if ($nv != "") {


               $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
               $voitures = $em
                   ->getRepository("MyAppUserBundle:Voiture")//appeler le repo qui a une liaison ave modele
                   ->findBy(array('nomville' => $nv));

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


   }



}
