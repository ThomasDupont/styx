<?php

namespace WebserviceBundle\Controller;

use coreBundle\Entity\WebsiteStyxuserbase;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use websiteBundle\Form\RegistrationFormType;

class UserController extends FOSRestController
{
  /**
  * @Rest\View()
  * @Rest\Get("/api/users")
  */
  public function UserListAction()
  {

    $users = $this->getDoctrine()
    ->getRepository('coreBundle:WebsiteStyxuserbase')
    ->findAll();

    /* @var $threads MessageThread[] */
    if (empty($users)) {
      return new JsonResponse(['message' => 'Users not found'], Response::HTTP_NOT_FOUND);
    }
    return $users;
  }

  /**
  * @Rest\View()
  * @Rest\Post("/api/users")
  */
  public function createUserAction(Request $request)
  {
    // $user = $this->container->get('security.context')->getToken()->getUser();
    $newUser = new WebsiteStyxuserbase();
    $form = $this->createForm(RegistrationFormType::class, $newUser);

    /** Validation des données */
    $form->submit($request->request->all());

    if($form->isValid()){
      // $newUser->setUser($user);

      $em = $this->getDoctrine()->getManager();
      $em->persist($newUser);
      $em->flush();
      return $newUser;
    }else{
      return $form;
    }
  }

}
