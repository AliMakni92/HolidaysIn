<?php

namespace MyApp\UserBundle\Controller;

use MyApp\UserBundle\Entity\Mail;
use MyApp\UserBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Swift_Message;


class MailController extends Controller
{
    public function indexAction(Request $request)
    {
        $mail = new Mail();
        $form = $this->createForm(MailType::class, $mail);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Accusé de réception')
                ->setFrom('espritplus2016@gmail.com')
                ->setTo($mail->getEmail())
                ->setBody($this->renderView(
                    'MyAppUserBundle:Mail:mail1.html.twig',
                    array('nom' => $mail->getNom(), 'prenom' => $mail->getPrenom(),'msg'=>$mail->getText())
                ),
                    'text/html');
            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('my_app_mail_accuse'));
        }
        return $this->render('MyAppUserBundle:Mail:index.html.twig', array('form' => $form->createView()));

    }
    public function successAction(){
        return new Response("email envoyé avec succès, Merci de vérifier votre adresse mail.");
    }


}
