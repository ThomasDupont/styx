<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\WebsiteStyxuserbase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use websiteBundle\Form\ConnexionFormType;
use websiteBundle\Form\RegistrationFormType;

class HomepageController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $session = new Session();
        $sessionStarted = $this->container->get('session')->isStarted();
        if(!$sessionStarted) {
            $session->start();
        }

        /*$user = new WebsiteStyxuserbase();
        $form = $this->createFormBuilder()->getForm();
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
        }

        return $this->render('websiteBundle:homepage:homepage.html.twig', array(
            'form'=>$form->createView(),
        ));*/

        $user = new WebsiteStyxuserbase();
        $connexionForm = $this->createForm(new ConnexionFormType(), $user);
        $registrationForm = $this->createForm(new RegistrationFormType(), $user);

        if ($connexionForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        if ($registrationForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render('websiteBundle:homepage:homepage.html.twig', array(
            'connexionForm' => $connexionForm->createView(),
            'formEmail' => $registrationForm->createView()
        ));
    }
    /*public function resetPasswordAction()
    {
        return $this->render('websiteBundle:homepage:password_reset.html.twig');
    }*/
}