<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilEtudiantController extends Controller
{
    public function indexAction()
    {
        $repositoryUser = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
        $idUser = $this->getUser()->getId();
        $user = $repositoryUser->findById($idUser)[0];

        return $this->render('@website/profil/student/profil.html.twig', array(
            'user' => $user,
        ));
    }
}
