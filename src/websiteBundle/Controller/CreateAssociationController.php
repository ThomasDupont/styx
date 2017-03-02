<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\WebsiteSocial;
use coreBundle\Entity\WebsiteStyxuserbase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use websiteBundle\Form\CreateAssociationFormType;

class CreateAssociationController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = new WebsiteStyxuserbase();
        $createAssociationForm = $this->createForm(new CreateAssociationFormType(), $user);

        if ($createAssociationForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        if ($request->getMethod() == 'POST') {
            $facebook = $createAssociationForm->get('facebook')->getData();
            $youtube = $createAssociationForm->get('youtube')->getData();
            $twitter = $createAssociationForm->get('twitter')->getData();
            $social = new WebsiteSocial();
            $social->setEntity($user);
            $social->setFacebook($facebook);
            $social->setYoutube($youtube);
            $social->setTwitter($twitter);
            $em = $this->getDoctrine()->getManager();
            $em->persist($social);
            $em->flush();
        }

        return $this->render('websiteBundle:association:create_association.html.twig', array(
            'createAssociationForm' => $createAssociationForm->createView(),
        ));
    }
}
