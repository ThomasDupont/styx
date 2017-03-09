<?php

namespace WebserviceBundle\Controller;

use coreBundle\Entity\MessageThread;
use coreBundle\Entity\PostPost;
use coreBundle\Entity\WebsiteStyxuserbase;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use websiteBundle\Form\CommentType;

class ConversationController extends FOSRestController
{
  /**
  * @Rest\View()
  * @Rest\Get("/api/conversation/thread/{participant}")
  */
  public function ConversationListAction($participant)
  {

    $provider = $this->container->get('fos_message.provider');
    $rawThreads = $provider->getInboxThreads();

    for ($i=0; $i < sizeof($rawThreads); $i++) {
      if($rawThreads[$i]->isParticipant($participant)) {
        $threads[] = $rawThreads[$i];
      }
    }

    /* @var $threads MessageThread[] */
    if (empty($threads)) {
      return new JsonResponse(['message' => 'Threads not found'], Response::HTTP_NOT_FOUND);
    }
    return $threads;
  }

}
