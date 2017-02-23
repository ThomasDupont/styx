<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\PostEvent;
use coreBundle\Entity\PostPost;
use coreBundle\Entity\WebsiteZone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use websiteBundle\Form\CityFormType;
use websiteBundle\Form\CreateEventFormType;
use websiteBundle\Form\CreatePostFormType;

class AgendaController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $this->container->get('session');
        $sessionStarted = $this->container->get('session')->isStarted();
        if(!$sessionStarted) {
            $session->start();
        }

        $repositoryGroup = $this->getDoctrine()->getRepository('coreBundle:WebsiteGroup');
        $repositoryZone = $this->getDoctrine()->getRepository('coreBundle:WebsiteZone');
        $repositoryStyxuserbase = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
        $repositoryStyxuserbaseZones = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbaseZones');
        $repositoryType = $this->getDoctrine()->getRepository('coreBundle:WebsiteType');

        $types = $repositoryType->findAll();

        $idUser = $this->getUser()->getId();
        $user = $repositoryStyxuserbase->findById($idUser)[0];
        $user_zone = $repositoryStyxuserbaseZones->findByStyxuserbase($user->getId())[0];
        // var_dump($repositoryStyxuserbaseZones->findByStyxuserbase($user->getId()));
        // var_dump($user_zone);

        if(array_key_exists('zone', $request->query->all())) {
            $zone = $repositoryZone->findById($request->query->get('zone'));
            $zone = $zone[0];
        } else if($repositoryGroup->findById($user->getGroup()->getId())[0]->getName() == 'student') {
            $zone = $repositoryStyxuserbaseZones->findByStyxuserbase($user->getId())[0]->getZone();
            $zone = $zone[0];
        } else {
            $zone = $repositoryZone->findById(1);
            $zone = $zone[0];
        }


        $ville = new WebsiteZone();
        $cityForm = $this->createForm(new CityFormType(), $ville);
        if ($cityForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();
        }

        $postpost = new PostPost();
        $postForm = $this->createForm(new CreateEventFormType(), $postpost);
        if ($postForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($postpost);
            $em->flush();
            $postid = $postpost->getId();
        }

        // var_dump($cityForm);
        // exit;
        return $this->render('websiteBundle:feed:agenda.html.twig', array(
            'cityForm' => $cityForm->createView(),
            'eventForm' => $postForm->createView(),
            'selected' => strval($zone->getId()),
            'types' => $types,
        ));
    }
}
