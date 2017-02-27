<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller
{
    public function indexAction()
    {
        $repositoryUser = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
        $idUser = $this->getUser()->getId();
        $userGroup = $this->getUser()->getGroup()->getId();
        $user = $repositoryUser->findById($idUser)[0];

        if ($userGroup == 1) {
            return $this->render('@website/profil/student/profil.html.twig', array(
                'user' => $user,
            ));
        } else if ($userGroup == 2) {
            return $this->render('@website/profil/association/profil.html.twig', array(
                'user' => $user,
            ));
        }
    }
}
