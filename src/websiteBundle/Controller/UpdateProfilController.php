<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\WebsiteStyxuserbase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use websiteBundle\Form\UpdateProfilFormType;

class UpdateProfilController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = new WebsiteStyxuserbase();
        $updateProfilForm = $this->createForm(new UpdateProfilFormType(), $user);

        if ($updateProfilForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render('websiteBundle:profil:update_profil.html.twig', array(
            'updateProfilForm' => $updateProfilForm->createView()
        ));
    }
}
