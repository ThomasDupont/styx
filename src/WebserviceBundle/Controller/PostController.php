<?php

namespace WebserviceBundle\Controller;

use coreBundle\Entity\PostPost;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class PostController extends FOSRestController
{
    /**
     * @Rest\View()
     * @Rest\Get("/api/post/zone/{zone}")
     */
    public function PostZoneListAction($zone)
    {
        $posts = $this->getDoctrine()
            ->getRepository('coreBundle:WebsiteStyxuserbaseZones')
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
        $comments = $this->getDoctrine()
            ->getRepository('coreBundle:PostComment')
            ->findBy(array('identifier' => $identifier ));
        if (empty($comments)) {
            return new JsonResponse(['message' => 'Comments not found'], Response::HTTP_NOT_FOUND);
        }
        return $comments;
    }
}