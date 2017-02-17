<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\PostPost;
use coreBundle\Entity\WebsiteZone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    // $request = new Request();

    // $user = $this->container->get('security.context')->getToken()->getUser();
    // var_dump($user);
    // $selected_category = null;  # si un utilisateur se trompe dans son formulaire, on doit garder sa sélection
    // $message = null;            # Message d'erreur pour l'utilisateur
    // $force_show_form = False;   # Doit-on réafficher le formulaire de nouvelle demande ?
    // $form_url = request.get_full_path();
    $repositoryGroup = $this->getDoctrine()->getRepository('coreBundle:WebsiteGroup');
    $repositoryPostPost = $this->getDoctrine()->getRepository('coreBundle:PostPost');
    $repositoryStyxuserbase = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
    $repositoryZone = $this->getDoctrine()->getRepository('coreBundle:WebsiteZone');
    $repositoryStyxuserbaseZones = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbaseZones');
    $repositoryPostPostZones = $this->getDoctrine()->getRepository('coreBundle:PostPostZones');
    $repositoryType = $this->getDoctrine()->getRepository('coreBundle:WebsiteType');
    $repositoryReward = $this->getDoctrine()->getRepository('coreBundle:PostReward');

    $types = $repositoryType->findAll();
    $rewards = $repositoryReward->findAll();

    // var_dump($repositoryZone->findById(1)[0]);

    $i = 1;
    while($repositoryPostPost->findById($i) != null) {
      $i++;
    }

    $j = 1;
    while($j < $i) {
      //      var_dump($repositoryPostPost->findById($j)[0]->getTitle());
      //      echo "<br/>";
      //      var_dump($repositoryPostPost->findById($j)[0]->getDescription());
      //      echo "<br/>";
      //      var_dump($repositoryPostPost->findById($j)[0]->getCreatedAt()->format('d/m/Y à H:i'));
      //      echo "<br/><br/>";
      $j++;
    }

    $idUser = $this->getUser()->getId();
    $user = $repositoryStyxuserbase->findById($idUser)[0];
    $user_zone = $repositoryStyxuserbaseZones->findByStyxuserbase($user->getId())[0];

    if ($repositoryGroup->findById($user->getGroup()->getId())[0]->getName() == 'student') {
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
        $zone = $request->query->get('filter');
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

    // var_dump($zone);
    // var_dump($session->get('newsfeed_filter'));

    // var_dump($filtre);

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


    $futur_event = $repositoryPostPostZones->findBy(array('zone'=>$zone));
    $def_posts = [];
    for ($i=0; $i < sizeof($futur_event); $i++) {
      $futur_event_posts[$i] = $futur_event[$i]->getPost();
      if(!$futur_event_posts[$i]->getDeleted()) {
        $def_posts[] = $futur_event_posts[$i];
      }
    }
    usort($def_posts, function($a, $b) {
      $a_current_date = $a->getPostponedAt() ?: $a->getCreatedAt();
      $b_current_date = $b->getPostponedAt() ?: $b->getCreatedAt();
      if($a_current_date == $b_current_date) {
        return 0;
      } else if($a_current_date > $b_current_date) {
        return 1;
      } else if($a_current_date < $b_current_date) {
        return -1;
      }
    });
    $futur_event = null;
    for ($i=0; $i < 6; $i++) {
      if(!empty($def_posts[$i])) {
        $futur_event[] = $def_posts[$i];
      }
    }

    //var_dump($futur_event);



    $ville = new WebsiteZone();
    $cityForm = $this->createForm(new CityFormType(), $ville);
    if ($cityForm->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($ville);
      $em->flush();
    }

    $post = new PostPost();
    $postForm = $this->createForm(new CreatePostFormType(), $post);
    if ($postForm->handleRequest($request)->isValid()) {
      $post->setOwner($this->getUser());
      $em = $this->getDoctrine()->getManager();
      $em->persist($post);
      $em->flush();
    }



    //exit;
    return $this->render('@website/feed/feed.html.twig', array(
      'cityForm' => $cityForm->createView(),
      'postForm' => $postForm->createView(),
      'types' => $types,
      'rewards' => $rewards,
    ));
  }
}
