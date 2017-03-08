<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends Controller
{
    public function indexAction()
    {
        $repositoryUser = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
        $repositorySocial = $this->getDoctrine()->getRepository('coreBundle:WebsiteSocial');
        $idUser = $this->getUser()->getId();
        $userGroup = $this->getUser()->getGroup()->getId();
        $user = $repositoryUser->findById($idUser)[0];
        if ($user->getGroup()->getName() == "association") {
            $social = $repositorySocial->findByEntity($user)[0];
        } else {
            $social = null;
        }

        if ($userGroup == 1) {
            return $this->render('@website/profil/student/profil.html.twig', array(
                'user' => $user,
                'connectedUser' => $user,
                'social' => $social,
            ));
        } else if ($userGroup == 2) {
            return $this->render('@website/profil/association/profil.html.twig', array(
                'user' => $user,
                'connectedUser' => $user,
                'social' => $social,

            ));
        }
    }

    public function otherProfilAction(Request $request)
    {
        $url = $request->getUri();
        $pos = strrpos($url, '/');
        $identifier = $pos === false ? $url : substr($url, $pos + 1);
        $repositoryUser = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
        $repositorySocial = $this->getDoctrine()->getRepository('coreBundle:WebsiteSocial');
        $user = $repositoryUser->findBy(array('identifier'=> $identifier));
        if ($user[0]->getGroup()->getName() == "association") {
            $social = $repositorySocial->findByEntity($user)[0];
        } else {
            $social = null;
        }

        $idUser = $this->getUser()->getId();
        $userGroup = $this->getUser()->getGroup()->getId();
        $connectedUser = $repositoryUser->findById($idUser)[0];

        if ($user == null) {
            if ($userGroup == 1) {
                return $this->render('@website/profil/student/profil.html.twig', array(
                    'user' => $connectedUser,
                    'social' => $social,
                ));
            } else {
                return $this->render('@website/profil/association/profil.html.twig', array(
                    'user' => $connectedUser,
                    'social' => $social,
                ));
            }
        }

        $userGroup = $user[0]->getGroup()->getId();
        if ($userGroup == 1) {
            return $this->render('@website/profil/student/profil.html.twig', array(
                'user' => $user[0],
                'connectedUser' => $connectedUser,
                'social' => $social,
            ));
        } else {
            return $this->render('@website/profil/association/profil.html.twig', array(
                'user' => $user[0],
                'connectedUser' => $connectedUser,
                'social' => $social,
            ));
        }
    }
}
