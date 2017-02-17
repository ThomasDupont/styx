<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\WebsiteStyxuserbase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\HttpFoundation\Request;
use websiteBundle\Form\UpdateProfilFormType;
use websiteBundle\Form\EmailNotificationFormType;

class UpdateProfilController extends Controller
{
    public function indexAction(Request $request)
    {
        $repositoryStyxuserbase = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
        $idUser = $this->getUser()->getId();
        $user = $repositoryStyxuserbase->findById($idUser)[0];

        $updateProfilForm = $this->createForm(new UpdateProfilFormType(), $user);
        $emailNotificationForm = $this->createForm(new EmailNotificationFormType(), $user);

        if ($updateProfilForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        if ($emailNotificationForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
//            $em->persist($user);
            $em->flush();
        }

        return $this->render('websiteBundle:profil:update_profil.html.twig', array(
            'updateProfilForm' => $updateProfilForm->createView(),
            'emailNotificationForm' => $emailNotificationForm->createView()
        ));
    }
}