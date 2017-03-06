<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function otherProfilAction(Request $request)
    {
        $url = $request->getUri();
        $pos = strrpos($url, '/');
        $identifier = $pos === false ? $url : substr($url, $pos + 1);
        $repositoryUser = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
        $user = $repositoryUser->findBy(array('identifier'=> $identifier));

        if ($user == null) {
            $idUser = $this->getUser()->getId();
            $userGroup = $this->getUser()->getGroup()->getId();
            $user = $repositoryUser->findById($idUser)[0];
            if ($userGroup == 1) {
                return $this->render('@website/profil/student/profil.html.twig', array(
                    'user' => $user,
                ));
            } else {
                return $this->render('@website/profil/association/profil.html.twig', array(
                    'user' => $user,
                ));
            }
        }

        $userGroup = $user[0]->getGroup()->getId();
        if ($userGroup == 1) {
            return $this->render('@website/profil/student/profil.html.twig', array(
                'user' => $user[0],
            ));
        } else {
            return $this->render('@website/profil/association/profil.html.twig', array(
                'user' => $user[0],
            ));
        }
    }
}
