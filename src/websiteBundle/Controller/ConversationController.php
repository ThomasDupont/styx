<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class ConversationController extends Controller
{
    public function indexAction(Request $request)
    {
      $session = $this->container->get('session');
      $sessionStarted = $this->container->get('session')->isStarted();
      if(!$sessionStarted) {
        $session->start();
      }

      $repositoryStyxuserbase = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
      $idUser = $this->getUser()->getId();
      $user = $repositoryStyxuserbase->findById($idUser)[0];

      $receiver = $repositoryStyxuserbase->findById(1)[0];

      // $composer = $this->container->get('fos_message.composer');
      // $thread = $composer->newThread();
      // $message = $thread
      //   ->setSender($user)
      //   ->addRecipient($receiver)
      //   ->setSubject('Hi there')
      //   ->setBody('This is a bonjour message')
      //   ->getMessage();
      // var_dump($message);

      // exit;
      // $thread = $message->getThread();

      // $message = $composer->reply($thread)
      //   ->setSender($receiver)
      //   ->setBody('This is the answer to the bonjour message')
      //   ->getMessage();

      // var_dump($thread->getSubject());
      // $sender = $this->container->get('fos_message.sender');
      // $sender->send($message);
      $provider = $this->container->get('fos_message.provider');
      $threads = $provider->getInboxThreads();
      foreach ($threads as $key => $value) {
        $threads[$key]->isRead = $threads[$key]->isReadByParticipant($user);
      }
      // var_dump($threads);
      // exit;
      return $this->render('@website/conversation/conversation.html.twig', array(
        'threads' => $threads,
        'user' => $user
      ));
    }
}
