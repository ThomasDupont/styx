<?php

namespace WebserviceBundle\Controller;


use coreBundle\Entity\PostComment;
use coreBundle\Entity\PostPost;
use coreBundle\Entity\PostPoll;
use coreBundle\Entity\PostNews;
use coreBundle\Entity\PostEvent;
use coreBundle\Entity\WebsiteStyxuserbase;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\ORM\Query\ResultSetMapping;

use websiteBundle\Form\CommentType;
use WebserviceBundle\Models\AuthentificationManager;

class PostController extends FOSRestController
{

    /**
    * @Rest\Get("/api/post/")
    */

    public function testAction()
    {
        return new JsonResponse(['message' => 'test'], Response::HTTP_OK);
    }
    /**
     * @Rest\Get("/api/zone/list/")
     */
    public function getZoneListAction()
    {
        $query = $this->getDoctrine()
            ->getRepository('codeBundle:WebsiteZone')
            ->createQueryBuilder('c')
            ->getQuery();
        $result = $query->getResult(Query::HYDRATE_ARRAY);
        return new JsonResponse(
            ['success' => true, 'resultType' => 'array', 'result' => $result],
            Response::HTTP_OK
        );
    }
    /**
    * @Rest\Get("/api/post/zone/{zone}")
    */
    public function PostZoneListAction(Request $request, $zone)
    {
        $auth = new AuthentificationManager($this->getDoctrine());
        if(
            $auth->checkApiUserCredential($request->request->get('apikey'), $request->request->get('secret'))
        ) {
            $posts = $this->getDoctrine()
            ->getRepository('coreBundle:PostPost')
            ->findByZone($zone);
            /* @var $posts PostPost[] */
            if (empty($posts)) {
              return new JsonResponse(['message' => 'Posts not found'], Response::HTTP_NOT_FOUND);
            }
            return new JsonResponse(['result' => $posts], Response::HTTP_OK);
        }
        return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
    }

    /**
    * @Rest\Get("/api/post/detail/{identifier}")
    */
    public function PostDetailAction(Request $request, $identifier)
    {
        $auth = new AuthentificationManager($this->getDoctrine());
        if(
            $auth->checkApiUserCredential($request->request->get('apikey'), $request->request->get('secret'))
        ) {
            $posts = $this->getDoctrine()
                ->getRepository('coreBundle:PostPost')
                ->findBy(array('identifier' => $identifier ));
            /* @var $posts PostPost[] */
            if (empty($posts)) {
                return new JsonResponse(['message' => 'Posts not found'], Response::HTTP_NOT_FOUND);
            }
            return new JsonResponse(
                ['success' => true, 'resultType' => 'array', 'result' => $posts],
                Response::HTTP_OK
            );
        }
        return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
    }

    /**
    * @Rest\Get("/api/comment/{identifier}/children")
    *
    */
    public function getCommentChildrenListAction(Request $request, $identifier)
    {
        $auth = new AuthentificationManager($this->getDoctrine());
        if(
            $auth->checkApiUserCredential($request->request->get('apikey'), $request->request->get('secret'))
        ) {
            $comments = $this->getDoctrine()
                ->getRepository('coreBundle:PostComment')
                ->findBy(array('identifier' => $identifier ));
            if (empty($comments)) {
              return new JsonResponse(['message' => 'Comments not found'], Response::HTTP_NOT_FOUND);
            }
            return $comments;
        }
        return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
    }

    /**
    * @Rest\Put("/api/post/action/{type}")
    * @param string $typeAction action of operation
    * @function Main function of post
    */
    public function postPostAction(Request $request, $type)
    {
      $post = (object) $request->request->get('post');
      $zone = $request->request->get('zone');
      $auth = new AuthentificationManager($this->getDoctrine());
      //check credentials of user
      if(
          $auth->checkApiUserCredential($request->request->get('apikey'), $request->request->get('secret'))
      ) {

            $userId = $auth->getUserId();
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('coreBundle:WebsiteStyxuserbase')->find($userId);
            //Pas d'id autoincrement sur post !
            $idPost = (int) $em->getConnection()->fetchColumn('SELECT MAX(id) FROM post_post') + 1;
            //Pass by the PostPost Entity throw an Exception Operation 'Doctrine\DBAL\Platforms\AbstractPlatform::getSequenceNextValSQL' is not supported by platform.

            $em->getConnection()->insert('post_post', [
              'id' => $idPost,
              'owner_id' => $userId,
              'title' => $post->title,
              'description' => $post->description,
              'created_at' => (new \Datetime())->format('Y-m-d H:i:s'),
              'has_comment' => true,
              'moderated' => false,
              'zone_id' => $zone
            ]);

            $postPost = $em->getRepository('coreBundle:PostPost')->find($idPost);

            switch ($type) {
              case 'poll':
                  $post = $this->postPoll($post, $zone, $postPost);
                  break;
              case 'news':
                  $post = $this->postNews($post, $zone, $postPost);
                  break;
              case 'event':
                  $post = $this->postEvent($post, $zone, $postPost);
                  break;

              default:
                  $post = $this->getDoctrine()
                    ->getRepository('coreBundle:PostPost')
                    ->findBy(['zone' => $zone]);
                  break;
            }
            return new JsonResponse(['result' => $idPost], Response::HTTP_OK);
      }
      return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
    }

    private function postPoll(\stdClass $post, $zone, $mainPost)
    {
        $em = $this->getDoctrine()->getManager();
        $postPoll = (new PostPoll())
            ->setPostPtr($mainPost)
            ->setQuestion($post->question)
            ->setMaxAnswer($post->maxAnswer);
        $em->persist($postPoll);
        $em->flush();
        return $postPoll;
    }

    private function postNews(\stdClass $post, $zone, $mainPost)
    {
        $em = $this->getDoctrine()->getManager();
        $postNews = (new PostNews())
            ->setPostPtr($mainPost);
        $em->persist($postNews);
        $em->flush();
        return $postNews;
    }

    private function postEvent(\stdClass $post, $zone, $mainPost)
    {
        //date format iso ISO8601
        $em = $this->getDoctrine()->getManager();
        $postEvent = (new PostEvent())
            ->setPostPtr($mainPost)
            ->setDate(new \Datetime($post->date))
            ->setPlace($post->place)
            ->setHour(new \Datetime($post->date))
            ->setAvatar($post->avatar);
        $em->persist($postEvent);
        $em->flush();
        return $postEvent;
    }

    /**
    * @Rest\Get("/api/post/list/{type}")
    */
    public function getPostAction(Request $request, $type)
    {
      $zone = $request->query->get('zone');
      $from = $request->query->get('from');
      $size = $request->query->get('size');
      $auth = new AuthentificationManager($this->getDoctrine());

      if(
          $auth->checkApiUserCredential($request->query->get('apikey'), $request->query->get('secret'))
      ) {

          switch ($type) {
              case 'poll':
                  $post = $this->getPoll($zone, $from, $size);
                  break;
              case 'news':
                  $post = $this->getNews($zone, $from, $size);
                  break;
              case 'event':
                  $post = $this->getEvent($zone, $from, $size);
                  break;

              default:
                  $em = $this->getDoctrine()->getManager();
                  $post = $em->getConnection()->executeQuery(
                      'SELECT * FROM post_post LIMIT ?,?',
                      [$from, $size],
                      [\PDO::PARAM_INT, \PDO::PARAM_INT]
                  )->fetchAll();
                  break;
          }
          return new JsonResponse(['result' => $post], Response::HTTP_OK);
      }
      return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
    }

    private function getPoll($zone, $from, $size)
    {
          $em = $this->getDoctrine()->getManager();
          $post = $em->createQueryBuilder()
              ->select('p, po')
              ->from('coreBundle:PostPoll', 'po')
              ->leftJoin('po.postPtr', 'p', 'WITH', 'p.id = po.postPtr')
              ->where('p.zone = :zone AND po.postPtr IS NOT NULL')
              ->andWhere('p.deleted = false')
              ->setFirstResult($from)
              ->setMaxResults($size)
              ->setParameter(':zone', $zone)
              ->getQuery()
              ->getArrayResult();
          /*
          $post = $em->getConnection()->executeQuery(
              'SELECT * FROM post_post p LEFT JOIN post_poll po ON p.id = po.post_ptr_id
              WHERE (p.zone_id = ? AND po.post_ptr_id IS NOT NULL) AND p.deleted = false LIMIT ?,?',
              [$zone, $from, $size],
              [\PDO::PARAM_INT, \PDO::PARAM_INT, \PDO::PARAM_INT]
          )->fetchAll();
        */
        return $post;
    }

    private function getNews($zone, $from, $size)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->createQueryBuilder()
            ->select('p, pn')
            ->from('coreBundle:PostNews', 'pn')
            ->leftJoin('pn.postPtr', 'p', 'WITH', 'p.id = pn.postPtr')
            ->where('p.zone = :zone AND pn.postPtr IS NOT NULL')
            ->andWhere('p.deleted = false')
            ->setFirstResult($from)
            ->setMaxResults($size)
            ->setParameter(':zone', $zone)
            ->getQuery()
            ->getArrayResult();
        return $post;
    }

    private function getEvent($zone, $from, $size)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->createQueryBuilder()
            ->select('p, pe')
            ->from('coreBundle:PostEvent', 'pe')
            ->leftJoin('pe.postPtr', 'p', 'WITH', 'p.id = pe.postPtr')
            ->where('p.zone = :zone AND pe.postPtr IS NOT NULL')
            ->andWhere('p.deleted = false')
            ->setFirstResult($from)
            ->setMaxResults($size)
            ->setParameter(':zone', $zone)
            ->getQuery()
            ->getArrayResult();
        return $post;
    }
    /**
    * @Rest\Put("/api/comment/{postId}")
    *
    */
    public function postCommentAction(Request $request, $postId)
    {
        $fatherId = $request->request->has('father') ? $request->request->get('father') : null;
        $comment = $request->request->get('comment');

        $auth = new AuthentificationManager($this->getDoctrine());
        if(
            $auth->checkApiUserCredential($request->request->get('apikey'), $request->request->get('secret'))
        ) {
            $userId = $auth->getUserId();
            $em = $this->getDoctrine()->getManager();
            //$user = $em->getRepository('coreBundle:WebsiteStyxuserbase')->find($userId);
            $commentId = (int) $em->getConnection()->fetchColumn('SELECT MAX(id) FROM post_comment') + 1;
            $date = (new \Datetime())->format('Y-m-d H:i:s');
            $em->getConnection()->insert('post_comment', [
              'id' => $commentId,
              'user_id' => $userId,
              'comment' => $comment,
              'post_id' => $postId,
              'father_id' => $fatherId,
              'created_at' => $date,
              'edited_at' => $date,
              'deleted' => false,
              'moderated' => false,
              'quick_answer' => true
            ]);
            return new JsonResponse(['success' => true, 'resultType' => 'int', 'result' => $commentId], 200);
        }
        return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
    }

    /**
    * @Rest\Get("/api/comment/{postId}")
    *
    */
   public function getCommentAction(Request $request, $postId)
   {
       $auth = new AuthentificationManager($this->getDoctrine());
       if(
           $auth->checkApiUserCredential($request->query->get('apikey'), $request->query->get('secret'))
       ) {
           $from = $request->query->get('from');
           $size = $request->query->get('size');

           $em = $this->getDoctrine()->getManager();
           $comments = $request->query->has('father') ?
               $em->createQueryBuilder()
                    ->select('p')
                    ->from('coreBundle:PostComment', 'p')
                    ->where('p.post = :post')
                    ->andWhere('p.father = :father')
                    ->setFirstResult($from)
                    ->setMaxResults($size)
                    ->setParameters(['post' => $postId, 'father' => $request->query->get('father')])
                    ->getQuery()
                    ->getArrayResult()
               /*
               $em->getConnection()->executeQuery(
                   'SELECT * FROM post_comment p
                   WHERE p.post_id = ? AND father_id = ? LIMIT ?,?',
                   [$postId, $request->query->get('father'), $from, $size],
                   [\PDO::PARAM_INT, \PDO::PARAM_INT, \PDO::PARAM_INT, \PDO::PARAM_INT]
               )->fetchAll() */:
               $em->createQueryBuilder()
                   ->select('p')
                   ->from('coreBundle:PostComment', 'p')
                   ->where('p.post = :post')
                   ->andWhere('p.father IS NULL')
                   ->setFirstResult($from)
                   ->setMaxResults($size)
                   ->setParameter('post', $postId)
                   ->getQuery()
                   ->getArrayResult();

            return new JsonResponse(['success' => true, 'resultType' => 'array', 'result' => $comments], Response::HTTP_OK);
        }
        return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
   }
   /**
    * @Rest\DELETE("/api/post/{postId}")
    */
   public function deletePostAction(request $request, $postId)
   {
       $auth = new AuthentificationManager($this->getDoctrine());
       if(
           $auth->checkApiUserCredential($request->request->get('apikey'), $request->request->get('secret'))
       ) {
            $userId = $auth->getUserId();
            $em = $this->getDoctrine()->getManager();
            /*
            $post = $em->getRepository('coreBundle:PostPost')
                ->findOneBy(['id' => $postId, 'owner' => $userId]);
            $post->setDeleted(true);
            $em->flush();
            */
            $query = $em->createQueryBuilder()
                ->delete('coreBundle:PostPost', 'p')
                ->where('p.id = :id AND owner = :user')
                ->setParameters(['id' => $postId, 'user' => $userId])
                ->getQuery();
            return $query->execute() ?
                new JsonResponse(['success' => true, 'resultType' => 'bool', 'result' => true], 200):
                new JsonResponse(['success' => false, 'codeError' => 404, 'message' => "This post is not found"], 404);
       }
       return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);

   }
   /**
    * @Rest\DELETE("/api/comment/{commentId}")
    */
   public function deleteCommentAction(request $request, $commentId)
   {
       $auth = new AuthentificationManager($this->getDoctrine());
       if(
           $auth->checkApiUserCredential($request->request->get('apikey'), $request->request->get('secret'))
       ) {
            $userId = $auth->getUserId();
            $em = $this->getDoctrine()->getManager();
           /*
           $comment = $em->getRepository('coreBundle:PostComment')
               ->findOneBy(['id' => $commentId, 'user' => $userId]);
           $post->setDeleted(true);
           $em->flush();
           */
            $query = $em->createQueryBuilder()
                ->delete('coreBundle:PostComment', 'c')
                ->where('c.id = :id AND c.user = :user')
                ->setParameters(['id' => $commentId, 'user' => $userId])
                ->getQuery();

            return $query->execute() ?
                new JsonResponse(['success' => true, 'resultType' => 'bool', 'result' => true], 200):
                new JsonResponse(['success' => false, 'codeError' => 404, 'message' => "The comment is not found"], 403);
       }
       return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
   }
    /**
     * @Rest\POST("/api/post/{postId}")
     */
   public function updatePostAction(request $request, $postId)
   {
       $type = $request->request->get('type');
       $auth = new AuthentificationManager($this->getDoctrine());
       if(
       $auth->checkApiUserCredential($request->request->get('apikey'), $request->request->get('secret'))
       ) {
           $userId = $auth->getUserId();
           $em = $this->getDoctrine()->getManager();
           $post = $em->getRepository('coreBundle:PostPost')
                ->findOneBy(['id' => $postId, 'owner' => $userId]);
           if(!is_null($post)) {
               if($request->request->has('zone')) {
                   $post->setZone($request->request->get('zone'));
               }
               if($request->request->has('catergory')) {
                   $post->setCategory($request->request->get('category'));
               }
               if($request->request->has('title')) {
                   $post->setTitle($request->request->get('title'));
               }
               if($request->request->has('description')) {
                   $post->setDescription($request->request->get('description'));
               }
               if($request->request->has('postPoned')) {
                   $post->setPostponedAt($request->request->get('postPoned'));
               }
               $post->setEditedAt(new \DateTime());
               switch ($type) {
                   case 'poll':
                       $poll = $em->getRepository('coreBundle:PostPoll')
                           ->findOneByPostPtr($postId);
                       if(!is_null($poll)) {
                           if ($request->request->has('question')) {
                               $poll->setQuestion($request->request->get('question'));
                           }
                           if ($request->request->has('maxAnswer')) {
                               $poll->setMaxAnswer($request->request->get('maxAnswer'));
                           }
                       } else {
                           new JsonResponse(['success' => false, 'codeError' => 404, 'message' => "The post is not found"], 404);
                       }

                       break;
                   case 'news':
                       break;
                   case 'event':
                       $event = $em->getRepository('coreBundle:PostEvent')
                           ->findOneByPostPtr($postId);
                       if(!is_null($event)) {
                           if ($request->request->has('date')) {
                               $event->setDate($request->request->get('date'));
                           }
                           if ($request->request->has('hour')) {
                               $event->setHour($request->request->get('hour'));
                           }
                           if ($request->request->has('place')) {
                               $event->setPlace($request->request->get('place'));
                           }
                           if ($request->request->has('avatar')) {
                               $event->setAvatar($request->request->get('avatar'));
                           }
                       } else {
                           new JsonResponse(['success' => false, 'codeError' => 404, 'message' => "The post is not found"], 404);
                       }
                       break;
               }
               $em->flush();
               new JsonResponse(['success' => true, 'resultType' => 'bool', 'result' => true], 200);
           }
           new JsonResponse(['success' => false, 'codeError' => 404, 'message' => "The post is not found"], 404);
       }
       return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
   }

    /**
     * @Rest\POST("/api/comment/{commentId}")
     */
    public function updateCommentAction(request $request , $commentId)
    {
        $commentText = $request->request->get('comment');
        $auth = new AuthentificationManager($this->getDoctrine());
        if(
        $auth->checkApiUserCredential($request->request->get('apikey'), $request->request->get('secret'))
        ) {
            $userId = $auth->getUserId();
            $em = $this->getDoctrine()->getManager();
            $comment = $em->getRepository('coreBundle:PostComment')
                ->findOneBy(['id' => $commentId, 'user' => $userId]);
            $comment->setComment($commentText);
            $em->flush();
        }
        return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
    }
}
