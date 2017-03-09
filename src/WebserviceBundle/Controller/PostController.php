<?php

namespace WebserviceBundle\Controller;

use coreBundle\Entity\PostComment;
use coreBundle\Entity\PostPost;
use coreBundle\Entity\WebsiteStyxuserbase;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use websiteBundle\Form\CommentType;

class PostController extends FOSRestController
{
  /**
  * @Rest\View()
  * @Rest\Get("/api/post/zone/{zone}")
  */
  public function PostZoneListAction($zone)
  {
    $posts = $this->getDoctrine()
    ->getRepository('coreBundle:PostPost')
    ->findBy(array("zone" => $zone));
    /* @var $posts PostPost[] */
    if (empty($posts)) {
      return new JsonResponse(['message' => 'Posts not found'], Response::HTTP_NOT_FOUND);
    }
    return $posts;
  }

  /**
  * @Rest\View()
  * @Rest\Get("/api/post/{identifier}")
  */
  public function PostDetailAction(Request $request, $identifier)
  {
    $posts = $this->getDoctrine()
    ->getRepository('coreBundle:PostPost')
    ->findBy(array('identifier' => $identifier ));
    /* @var $posts PostPost[] */
    if (empty($posts)) {
      return new JsonResponse(['message' => 'Posts not found'], Response::HTTP_NOT_FOUND);
    }
    return $posts;
  }

  /**
  * @Rest\View()
  * @Rest\Get("/api/comment/{identifier}/children")
  *
  */
  public function getCommentChildrenListAction(Request $request, $identifier)
  {
    /** @var WebsiteStyxuserbase $user */

    var_dump($user->getEmail());
    $comments = $this->getDoctrine()
    ->getRepository('coreBundle:PostComment')
    ->findBy(array('identifier' => $identifier ));
    if (empty($comments)) {
      return new JsonResponse(['message' => 'Comments not found'], Response::HTTP_NOT_FOUND);
    }
    return $comments;
  }
  /**
  * @Rest\View()
  * @Rest\Post("/api/comment/{identifier}/children")
  *
  */
  public function postCommentChildrenListAction(Request $request, $identifier)
  {
    $user = $this->container->get('security.context')->getToken()->getUser();
    $comments = new PostComment();
    $form = $this->createForm(CommentType::class, $comments);

    /** Validation des données */
    $form->submit($request->request->all());

    if($form->isValid()){
      $comments->setUser($user);

      $em = $this->getDoctrine();
      $em->persist($comments);
      $em->flush();
      return $comments;
    }else{
      return $form;
    }

  }
}
