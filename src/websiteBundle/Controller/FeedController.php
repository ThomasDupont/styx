<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\PostPost;
use coreBundle\Entity\PostPostZones;
use coreBundle\Entity\WebsiteZone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use coreBundle\Entity\WebsiteStyxuserbase;
use coreBundle\Entity\WebsiteStyxuserbaseZones;
use websiteBundle\Form\CityFormType;
use websiteBundle\Form\CreatePostFormType;

class FeedController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $session = $this->container->get('session');
        $sessionStarted = $this->container->get('session')->isStarted();
        if(!$sessionStarted) {
            $session->start();
        }

        $repositoryGroup = $this->getDoctrine()->getRepository('coreBundle:WebsiteGroup');
        $repositoryPostPost = $this->getDoctrine()->getRepository('coreBundle:PostPost');
        $repositoryPostEvent = $this->getDoctrine()->getRepository('coreBundle:PostEvent');
        $repositoryStyxuserbase = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
        $repositoryZone = $this->getDoctrine()->getRepository('coreBundle:WebsiteZone');
        $repositoryStyxuserbaseZones = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbaseZones');
        $repositoryPostPostZones = $this->getDoctrine()->getRepository('coreBundle:PostPostZones');
        $repositoryType = $this->getDoctrine()->getRepository('coreBundle:WebsiteType');
        $repositoryReward = $this->getDoctrine()->getRepository('coreBundle:PostReward');

        $types = $repositoryType->findAll();
        $rewards = $repositoryReward->findAll();
        $users = count($repositoryStyxuserbase->findAll());

        $idUser = $this->getUser()->getId();
        $user = $repositoryStyxuserbase->findById($idUser)[0];

        if ($repositoryGroup->findById($user->getGroup()->getId())[0]->getName() == 'etudiant') {
            $user_zone = $repositoryStyxuserbaseZones->findByStyxuserbase($user->getId())[0];
        } else {
            if ($repositoryStyxuserbaseZones->findByStyxuserbase($user->getId()) == NULL) {
                $user_zone = $repositoryStyxuserbaseZones->findById(1)[0];
            } else {
                $user_zone = $repositoryStyxuserbaseZones->findByStyxuserbase($user->getId())[0];
            }
        }

        if ($repositoryGroup->findById($user->getGroup()->getId())[0]->getName() == 'etudiant') {
            if($user_zone->getZone() != NULL) {
                $name_zone = $user_zone->getZone()->getName();  # Nom de la ville de l'utilisateur
            } else {
                $name_zone = 'Orléans';
            }
        } else {
            $name_zone = 'Orléans';
        }
        $filtres = [$name_zone];


        if($session->get('newsfeed_filter') != NULL) {
            $filtre = $session->get('newsfeed_filter');
        } else {
            $filtre = 0;
        }

        if(array_key_exists('filter', $request->query->all())) {
            $filtre = $request->query->get('filter');
            $session->set('newsfeed_filter', (Integer)$filtre-1);
            if(array_key_exists('zone', $request->query->all())) {
                $zone = $request->query->get('zone');
                $session->set('zone_filter', $zone);
            }
            header("Location: /feed");
            exit;
        }

        if($user_zone->getZone() != NULL) {
            $zone = $user_zone->getZone();
        } else {
            // $zone = $repositoryZone->findById(1)[0];
        }

        $posts = null;

        if($filtre == 0) {
            $posts = $repositoryPostPostZones->findByZone($zone->getId());
            if($session->get('zone_filter') != NULL) {
                $zone_filter = $session->get('zone_filter');
            } else {
                $zone_filter = 1;
            }
        }

        if($filtre == 1) {
            if($session->get('zone_filter') != NULL) {
                $zone_filter = $session->get('zone_filter');
            } else {
                $zone_filter = 0;
            }
            $posts = $repositoryPostPostZones->findByZone($zone_filter);
            if($repositoryZone->findById($zone_filter)[0] != NULL) {
                $zone = $repositoryZone->findById($zone_filter)[0];
            } else {
                $zone = $repositoryZone->findById(1)[0];
            }
            $name_zone = $zone->getName();
        }

        $filtre = $session->get('newsfeed_filter');
        if(!$filtre) {
            $filtre = 0;
        }
        $zone = $session->get('zone_filter');
        if(!$zone) {
            $zone = 1;
        }
        $zone = $repositoryZone->findById($zone)[0];


        $i = 1;
        while($repositoryPostPost->findById($i) != null) {
            $i++;
        }

        // var_dump($zone->getId());

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('
    SELECT pp
    FROM coreBundle:PostPost pp
    WHERE pp.zone = :zone
    ')
            ->setParameter('zone', $zone);
        $posts = null;
        $posts = $query->getResult();
        for ($i=0; $i < sizeof($posts); $i++) {
            $posts[$i] = array('post' => $posts[$i]);
        }

        $future_event = $repositoryPostEvent->findAll();
        $real_future_event = array();
        foreach ($future_event as $event) {
            if ($event->getPostPtr()->getZone() == $zone) {
                $real_future_event[] = $event;
            }
        }
        $def_posts = [];
        for ($i=0; $i < sizeof($real_future_event); $i++) {
            if(!$real_future_event[$i]->getPostPtr()->getDeleted()) {
                $def_posts[] = $real_future_event[$i];
            }
        }
        usort($def_posts, function($a, $b) {
            $a_current_date = $a->getDate();
            $b_current_date = $b->getDate();
            if($a_current_date == $b_current_date) {
                return 0;
            } else if($a_current_date > $b_current_date) {
                return 1;
            } else if($a_current_date < $b_current_date) {
                return -1;
            }
        });

        $real_future_event = null;
        for ($i=0; $i < 3; $i++) {
            if(!empty($def_posts[$i])) {
                $real_future_event[] = $def_posts[$i]->getPostPtr();
            }
        }

        if (!empty($real_future_event)) {
            foreach ($real_future_event as $event) {
                var_dump($event->getTitle());
            }
        }

        //var_dump($futur_event);

        // var_dump($posts);

        $ville = new WebsiteZone();
        $cityForm = $this->createForm(new CityFormType(), $ville);
        if ($cityForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();
        }

        $repositoryReward = $this->getDoctrine()->getRepository('coreBundle:PostReward');
        $rewards = $repositoryReward->findAll();
        // $rewards = ['rewardsss' => $rewards];
        // var_dump($rewards);
        // exit;

        $postpost = new PostPost();
        $postForm = $this->createForm(new CreatePostFormType(), $postpost);
        if ($postForm->handleRequest($request)->isValid()) {
            $postpost->setOwner($this->getUser());
            $postpost->setZone($zone);
            $em = $this->getDoctrine()->getManager();
            $em->persist($postpost);
            $em->flush();
            $postid = $postpost->getId();
            return $this->redirect($this->generateUrl($request->get('_route'), $request->query->all()));
        }

        // exit;
        return $this->render('@website/feed/feed.html.twig', array(
            'cityForm' => $cityForm->createView(),
            'postForm' => $postForm->createView(),
            'posts' => $posts,
            'futur_event' => $real_future_event,
            'types' => $types,
            'rewards' => $rewards,
            'users' => $users,
            'zone' => $zone,
            'selected' => strval($zone->getId()),
        ));
    }

    //     public function connected_user_count() {
    //       $since_day = timezone.now() - timedelta(days=3);
    //       $since_day.strftime('%m%d%y');
    //       return len(StyxUserBase.objects.filter(last_login__gt=since_day));

}
