<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\WebsiteSocial;
use coreBundle\Entity\WebsiteStyxuserbase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\HttpFoundation\Request;
use websiteBundle\Form\SocialFormType;
use websiteBundle\Form\UpdateProfilFormType;
use websiteBundle\Form\EmailNotificationFormType;

class UpdateProfilController extends Controller
{
    public function indexAction(Request $request)
    {
        $repositoryStyxuserbase = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
//        $repositorySocial = $this->getDoctrine()->getRepository('coreBundle:WebsiteSocial');
        $idUser = $this->getUser()->getId();
        $user = $repositoryStyxuserbase->findById($idUser)[0];
//        $social = $repositorySocial->findBy(array('entity' => $idUser));

        $updateProfilForm = $this->createForm(new UpdateProfilFormType(), $user);
        $emailNotificationForm = $this->createForm(new EmailNotificationFormType(), $user);

        if ($updateProfilForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        if ($emailNotificationForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

//        if ($updateSocialForm->handleRequest($request)->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($social);
//            $em->flush();
//        }

        $websiteSocial = new WebsiteSocial();
        $socialForm = $this->createForm(new SocialFormType(), $websiteSocial);
        if ($socialForm->handleRequest($request)->isValid()) {
            $websiteSocial->setId($idUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($websiteSocial);
            $em->flush();
        }

        return $this->render('websiteBundle:profil:update_profil.html.twig', array(
            'updateProfilForm' => $updateProfilForm->createView(),
            'emailNotificationForm' => $emailNotificationForm->createView(),
            'updateSocial' => $socialForm->createView(),
            'user' => $user
        ));
    }

    public function onPreSubmit(FormEvent $event)
    {
        $params = $event->getData();

        if (!isset($params['email'])) {
            $event->getForm()->remove('email');
        }
    }
}