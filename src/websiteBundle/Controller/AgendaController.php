<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\WebsiteZone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use websiteBundle\Form\CityFormType;

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

    $idUser = $this->getUser()->getId();
    $user = $repositoryStyxuserbase->findById($idUser)[0];
    $user_zone = $repositoryStyxuserbaseZones->findByStyxuserbase($user->getId())[0];
    // var_dump($repositoryStyxuserbaseZones->findByStyxuserbase($user->getId()));
    // var_dump($user_zone);

    if(array_key_exists('zone', $request->query->all())) {
      $zone = $repositoryZone->findById($request->query->get('zone'));
    } else if($repositoryGroup->findById($user->getGroup()->getId())[0]->getName() == 'student') {
      $zone = $repositoryStyxuserbaseZones->findByStyxuserbase($user->getId())[0]->getZone();
    } else {
      $zone = $repositoryZone->findById(1);
    }
    $zone = $zone[0];
    // var_dump($zone->getName());
    // exit;

















    $ville = new WebsiteZone();
    $cityForm = $this->createForm(new CityFormType(), $ville);
    if ($cityForm->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($ville);
      $em->flush();
    }

    // var_dump($cityForm);
    // exit;
    return $this->render('websiteBundle:feed:agenda.html.twig', array(
      'cityForm' => $cityForm->createView(),
      'selected' => strval($zone->getId()),
    ));
  }
}
