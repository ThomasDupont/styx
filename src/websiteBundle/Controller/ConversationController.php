<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConversationController extends Controller
{
    public function indexAction()
    {
      $session = $this->container->get('session');
      $sessionStarted = $this->container->get('session')->isStarted();
      if(!$sessionStarted) {
          $session->start();
      }

      $provider = $container->get('fos_message.provider');
      $threads = $provider->getInboxThreads();
      var_dump($threads);
      exit;
      return $this->render('websiteBundle:conversation:conversation.html.twig');
    }
}
