<?php

namespace MyApp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use MyApp\UserBundle\Form\VolType;
use MyApp\UserBundle\Entity\Vol;
use MyApp\UserBundle\Entity\ReservationVol;

class VolController extends Controller
{
    public function addVolAction(Request $request)
    {



        $vol = new Vol();
        $form = $this->createForm(VolType::class, $vol);

        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($vol->getDateDepart() >$vol->getDateArrivee()) {
                echo "<script>alert(\"date depart doit etre avant ou a la meme  date d'arrivee \")
                </script>";
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($vol);
                $em->flush();
                return $this->redirectToRoute("afficherVol");
            }
        }
        $login = $request->get('adminadmin');
        return $this->render("MyAppUserBundle:Vol:addVol.html.twig", array("f" => $form->createView(),'loginAdmin'=>$login));

    }




    public function afficheVolAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $vol = $em
            ->getRepository("MyAppUserBundle:Vol")//appeler le repo qui a une liaison ave modele
            ->findAll();//recucperer la liste des modeles de la bd
        if ($request->isMethod("post")) {
            $nv = $request->get('compagnieAerienne');
            if ($nv != "") {


                $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                $vol = $em
                    ->getRepository("MyAppUserBundle:Vol")//appeler le repo qui a une liaison ave modele
                    ->findBy(array('compagnieAerienne' => $nv));
                return $this->render("MyAppUserBundle:Vol:Vol.html.twig", array("ms" => $vol));
            }
            else{
                $em = $this->getDoctrine()->getManager();// gestionnaire des entités c lui qui gere les entités(insertion,modif,supp,affichage)
                $users = $em
                    ->getRepository("MyAppUserBundle:Vol")//appeler le repo qui a une liaison ave modele
                    ->findAll();//recucperer la liste des modeles de la bd
            }
        }

        return $this->render("MyAppUserBundle:Vol:Vol.html.twig", array("ms" => $vol));


    }

    public function deleteAction($numVol) {

        $em=$this->getDoctrine()->getManager();
        $vol=$em
            ->getRepository("MyAppUserBundle:Vol")
            ->find($numVol);
        $em->remove($vol);
        $em->flush();
        return $this->redirectToRoute("afficherVol");

    }


    public function updateAction(Request $request,$numVol){
        $em=$this->getDoctrine()->getManager();
        $vol=$em
            ->getRepository("MyAppUserBundle:Vol")
            ->find($numVol);
        $form = $this->createForm(VolType::class,$vol);

        $form->handleRequest($request);
        if($form->isValid()) {
            if ($vol->getDateDepart() > $vol->getDateArrivee()) {
                echo "<script>alert(\"date depart doit etre avant ou a la meme  date d'arrivee \")
                </script>";
            } else {

                $em->persist($vol);
                $em->flush();
                return $this->redirectToRoute("afficherVol");
            }
        }
        $login = $request->get('adminadmin');
        return $this->render("MyAppUserBundle:Vol:updateVol.html.twig", array("f" => $form->createView(),'loginAdmin'=>$login));


    }


    public function afficheVolClientAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $login = $request->get('username');
        $vol = $em
            ->getRepository("MyAppUserBundle:Vol")
            ->findAll();
        if ($request->isMethod("post")) {
            $nv = $request->get('compagnieAerienne');
            if ($nv != "") {


                $em = $this->getDoctrine()->getManager();
                $vol = $em
                    ->getRepository("MyAppUserBundle:Vol")
                    ->findBy(array('compagnieAerienne' => $nv));
                return $this->render("MyAppUserBundle:Vol:InterfaceVolClient.html.twig", array("ms" => $vol,'username' => $login));
            }
            else{
                $em = $this->getDoctrine()->getManager();
                $users = $em
                    ->getRepository("MyAppUserBundle:Vol")
                    ->findAll();
            }
        }
        $login = $request->get('username');
        return $this->render("MyAppUserBundle:Vol:InterfaceVolClient.html.twig", array("ms" => $vol,'username' => $login));


    }
    public function ReserverVolAction(Request $request)
    {

        $login = $request->get('username');
        $compagnieAerienne = $request->get('compagnieAerienne');
        $aeroportDepart = $request->get('aeroportDepart');
        $aeroportArrivee = $request->get('aeroportArrivee');
        $dateDepart = $request->get('dateDepart');
        $dateArrivee = $request->get('dateArrivee');
        $nbrePlacesDispo = $request->get('nbrePlacesDispo');
        $prix = $request->get('prix');
        if ($request->isMethod("post")) {
            $ReservationVol = new ReservationVol();
            $numVol= $request->get('numVol');
            $em = $this->getDoctrine()->getManager();
            //$vol = new Vol();

            $vol = $em
                ->getRepository("MyAppUserBundle:Vol")
                ->find($numVol);
            $login = $request->get('username');
            $em = $this->getDoctrine()->getManager();
            //$user = new User();
            $user = $em
                ->getRepository("MyAppUserBundle:User")
                ->findOneBy(array('username' => $login));
            $ReservationVol->setId($user);
            $ReservationVol->setNumVol($vol);
            // $date = new \DateTime();


            $ReservationVol->setDate(new \DateTime());
            $n = $request->get('n');
            $nbr = $vol->getNbrePlacesDispo();

            $np = $nbr - $n;
            if ($np < 0) {
                echo "<script>alert(\"le nbr de places ne doit pas etre superieur a: $nbr \")
                </script>";

            } else {
                $vol->setNbrePlacesDispo($np);
                $ReservationVol->setNombrePersonne($n);

                $em->persist($ReservationVol);
                $em->persist($vol);

                $em->flush();


                echo "<script>alert(\"Reservation reussi : \")
                </script>";
            }

        }



        return $this->render('MyAppUserBundle:Vol:reserverVol.html.twig',
            array('username' => $login, 'compagnieAerienne' => $compagnieAerienne, 'aeroportDepart' => $aeroportDepart,
                'aeroportArrivee' => $aeroportArrivee, 'dateDepart' => $dateDepart,
                'dateArrivee' => $dateArrivee, 'nbrePlacesDispo' => $nbrePlacesDispo, 'prix' => $prix));

    }
    public function listReservationVolAction(Request $request)
    {               require('phpToPDF.php');

        $em = $this->getDoctrine()->getManager();
        $login = $request->get('username');
        $reservation = $em->getRepository("MyAppUserBundle:ReservationVol")->findAll();

        $my_html="<HTML>
<h2>liste reservation des vols 
</h2><br>
<h5>
Suite à notre entretien / conversation téléphonique du _____ [Indiquez la date], je vous confirme la réservation faite pour une chambre dans votre hôtel / 
la location de ____ [Précisez le type d'hébergement]. Je vous rappelle que mon arrivée est prévue pour le ____ 
[Indiquez la date d'arrivée]. La réservation a été faite jusqu'au _____ [Indiquez la date de départ prévue]. J'ai demandé ___ [Précisez le nombre et la nature 
des chambres réservées] chambre simple / double / simples / doubles, en pension / demi-pension / sans pension pour ____ personnes [Précisez le nombre de personnes].
 Conformément à ce dont nous étions convenus, je vous joins le paiement de ____ [Indiquez le montant] euros correspondant aux arrhes demandées. Veuillez 
 agréer, Madame / Monsieur, l'expression de mes sincères salutations. 
</h5>

</HTML>";

        //Set Your Options -- we are saving the PDF as 'my_filename.pdf' to a 'my_pdfs' folder
        $pdf_options = array(
            "source_type" => 'html',
            "source" => $my_html,
            "action" => 'save',
            "save_directory" => 'C:\Users\Public\Pictures',
            "file_name" => 'my_filename.pdf');

        //Code to generate PDF file from options above
        phptopdf($pdf_options);

        return $this->render("MyAppUserBundle:Vol:listReservationVol.html.twig", array( 'username' => $login, 'rs' => $reservation));

    }

}
