<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\PostEvent;
use coreBundle\Entity\PostPost;
use coreBundle\Entity\WebsiteZone;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use websiteBundle\Form\CityFormType;
use websiteBundle\Form\CreateEventDetailsFormType;
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

        if(array_key_exists('zone', $request->query->all())) {
            $zone = $repositoryZone->findById($request->query->get('zone'));
            $zone = $zone[0];
        } else if($repositoryGroup->findById($user->getGroup()->getId())[0]->getName() == 'student') {
            $zone = $repositoryStyxuserbaseZones->findByStyxuserbase($user->getId())[0]->getZone();
        } else {
            $zone = $repositoryZone->findById(1);
            $zone = $zone[0];
        }

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('
        SELECT pe
        FROM coreBundle:PostEvent pe, coreBundle:PostPost pp
        WHERE pe.postPtr = pp.id
        AND pp.zone = :zone
        AND pe.date > :date
        ORDER BY pe.date
        ')
            ->setParameter('zone', $zone)
            ->setParameter('date', new DateTime());
        $posts = $query->getResult();


        $query = $em->createQuery('
        SELECT pe.date
        FROM coreBundle:PostEvent pe, coreBundle:PostPost pp
        WHERE pe.postPtr = pp.id
        AND pp.zone = :zone
        ORDER BY pe.date
        ')
            ->setParameter('zone', $zone);
        $dateResult = $query->getResult();
        $dates = array();
        for ($i=0; $i < sizeof($dateResult); $i++) {
            $dates[$i] = $dateResult[$i]["date"]->format('F Y');
        }
        $years = $dates;
        for ($i=0; $i < sizeof($dates); $i++) {
            if ($i + 1 < sizeof($dates)) {
                $years[$i] = $dates[$i + 1];
            }
        }
        $arrayYears = array();
        $lastDate = 0;
        for ($i=0; $i < sizeof($dates); $i++) {
            $testDate = substr($dates[$i], -4);
            if ($lastDate != $testDate) {
                $arrayYears[] = 1;
            } else {
                $arrayYears[] = 0;
            }
            $lastDate = $testDate;
        }

        $arrayMonths = array();
        $arrayMonths[] = 1;
        for ($i=1; $i < sizeof($dates); $i++) {
            $testDate = substr($dates[$i], 0, -5);
            if ($lastDate != $testDate) {
                $arrayMonths[] = 1;
            } else {
                $arrayMonths[] = 0;
            }
            $lastDate = $testDate;
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
            $postpost->setOwner($this->getUser());
            $postpost->setZone($zone);
            $em = $this->getDoctrine()->getManager();
            $em->persist($postpost);
            $em->flush();
        }

        if ($request->getMethod() == 'POST') {
            $dates = $postForm->get('date')->getData();
            $hour = $postForm->get('hour')->getData();
            $place = $postForm->get('place')->getData();
            $postEvent = new PostEvent();
            $postEvent->setPostPtr($postpost);
            $postEvent->setDate($dates);
            $hour = DateTime::createFromFormat("G:i", $hour);
            $postEvent->setHour($hour);
            $postEvent->setPlace($place);
            $em = $this->getDoctrine()->getManager();
            $em->persist($postEvent);
            $em->flush();
            return $this->redirect($this->generateUrl($request->get('_route'), $request->query->all()));

        }

        $userGroup = $this->getUser()->getGroup()->getName();

        return $this->render('websiteBundle:feed:agenda.html.twig', array(
            'cityForm' => $cityForm->createView(),
            'eventForm' => $postForm->createView(),
            'selected' => strval($zone->getId()),
            'types' => $types,
            'userGroup' => $userGroup,
            'posts' => $posts,
            'dates' => $dates,
            'years' => $arrayYears,
            'months' => $arrayMonths,
        ));
    }
}
