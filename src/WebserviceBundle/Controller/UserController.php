<?php

namespace WebserviceBundle\Controller;

use coreBundle\Entity\WebsiteStyxuserbase;
use coreBundle\Entity\ApiAuth;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use websiteBundle\Form\RegistrationFormType;


use WebserviceBundle\Models\AuthentificationManager;

class UserController extends FOSRestController
{

    private $algo = "sha256";
    /**
    * @Rest\Get("/api/users")
    */
    public function UserListAction()
    {
        $apikey = "bonjour";


        $users = $this->getDoctrine()
        ->getRepository('coreBundle:WebsiteStyxuserbase')
        ->findAll();

        /* @var $threads MessageThread[] */
        if (empty($users)) {
          return new JsonResponse(['message' => 'Users not found'], Response::HTTP_OK);
        }
        return new JsonResponse(['message' => $users], Response::HTTP_OK);
    }

    /**
    * @Rest\Put("/api/users/new")
    */
    public function createUserAction(Request $request)
    {

        if(!$request->request->has('email') || !$request->request->has('password') || !$request->request->has('name'))
        {
            return new JsonResponse(['success' => false, 'message' => 'invalide request'], Response::HTTP_OK);
        }
        $salt = $this->createSalt();
        $newUser = (new WebsiteStyxuserbase())
            //@TODO dans l'entité, le username = email
            ->setUsername($request->request->get('username'))
            ->setEmail($request->request->get('email'))
            ->setPassword(
                $this->encodePassword(
                    $request->request->get('password'),
                    $salt
                )
            )
            ->setName($request->request->get('name'))
            ->setSalt($salt);

        $em = $this->getDoctrine()->getManager();
        try{
            $em->persist($newUser);
            $em->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['success' => false, 'message' => 'This user still exist'], 500);
        }

        $userId = $newUser->getId();
        $secret = $this->generateApiSecret();
        $apikey = uniqid();
        //Pass by the ApiAuth Entity throw an Exception Operation 'Doctrine\DBAL\Platforms\AbstractPlatform::getSequenceNextValSQL' is not supported by platform.
        $em->getConnection()->insert('api_auth', [
            'user_id' => $userId,
            'apiKey' => $apikey,
            'secret' => $secret
        ]);

        return new JsonResponse(['apikey' => $apikey, 'secret' => $secret], Response::HTTP_OK);
    }

    /**
    * @Rest\DELETE("/api/users/delete")
    */
    public function deleteUserAction(Request $request)
    {
        $apikey = $request->request->get('apikey');
        $secret = $request->request->get('secret');
        $em = $this->getDoctrine()->getManager();
        $auth = $em->getRepository('coreBundle:ApiAuth')
            ->findOneBy(['apikey' => $apikey, 'secret' => $secret]);
        if(is_null($auth)) {
            return new JsonResponse(['success' => false, 'message' => "The user is not found"], 500);
        }
        $user = $em->getRepository('coreBundle:WebsiteStyxuserbase')
            ->find($auth->getUser());
        //Attention, check on mysql if the Api_Auth index is deleting on cascade
        $em->remove($user);
        $em->flush();
        return new JsonResponse(['success' => true], Response::HTTP_OK);
    }

    /**
    * @Rest\Put("/api/facebook")
    */
    public function facebookAction(Request $request)
    {

    }

    private function generateFacebookLongtimeToken($token)
    {
      file_get_contents('/oauth/access_token?
        grant_type=fb_exchange_token&
        client_id={app-id}&
        client_secret={app-secret}&
        fb_exchange_token={'.$token.'}'
        );
    }

    /**
    * @Rest\Post("/api/users/login")
    */
    public function loginAction (Request $request)
    {
      $username = $request->request->get('username');
      $password = $request->request->get('password');

      if(is_null($username) || is_null($password)) {
          return new Response(
            'Please verify all your inputs.',
            Response::HTTP_UNAUTHORIZED,
            array('Content-type' => 'application/json')
          );
      }

      //$userManager = $this->get('fos_user.user_manager');
      //$factory = $this->get('security.encoder_factory');
      $em = $this->getDoctrine()->getManager();
      $user = $em->getRepository('coreBundle:WebsiteStyxuserbase')
                    ->findOneByUsername($username);
      if(is_null($user)) {
          return new Response(
            'Username or Password not valid.',
            Response::HTTP_UNAUTHORIZED,
            array('Content-type' => 'application/json')
          );
      }
      //$user = $userManager->findUserByUsername($username);
      //$encoder = $factory->getEncoder($user);
      $salt = $user->getSalt();
      //if($encoder->isPasswordValid($user->getPassword(), $password, $salt)) {
      if($this->verifpassword($password, $user->getPassword(), $salt)) {

          $currentAuth = $em->getRepository('coreBundle:ApiAuth')->findOneByUser($user);

          $secret = $this->generateApiSecret();
          $apikey = $currentAuth->getApikey();

          $currentAuth->setSecret($secret);

          $em->persist($currentAuth);
          $em->flush();
          // return the credential to use to the client
          return new JsonResponse(['apikey' => $apikey, 'secret' => $secret], Response::HTTP_OK);

      } else {
          return new Response(
            'Username or Password not valid.',
            Response::HTTP_UNAUTHORIZED,
            array('Content-type' => 'application/json')
          );
      }

    }

    public function disconnect (Request $request)
    {

    }

    /**
     * @Rest\Post("/api/users/update")
     */
    public function updateProfil (Request $request)
    {
        $auth = new AuthentificationManager($this->getDoctrine());
        if(
        $auth->checkApiUserCredential($request->request->get('apikey'), $request->request->get('secret'))
        ) {
            $userId = $auth->getUserId();
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('coreBundle:WebsiteStyxuserbase')
                ->find($userId);
            if(!is_null($user)) {
                if ($request->request->has('mobile')) {
                    $user->setMobile($request->request->get('mobile'));
                }
                if ($request->request->has('address')) {
                    $user->setAdress($request->request->get('address'));
                }
                if ($request->request->has('name')) {
                    $user->setName($request->request->get('name'));
                }
                if ($request->request->has('username')) {
                    $user->setUsername($request->request->get('username'));
                }
                if ($request->request->has('zipCode')) {
                    $user->setZipCode($request->request->get('zipCode'));
                }
                if ($request->request->has('password')) {
                    $user->setPassword(
                        $this->encodePassword(
                            $request->request->get('password'), $user->getSalt()
                        )
                    );
                }
            }
            $em->persist($user);
            $em->flush();
            return new JsonResponse(['success' => true, 'resultType' => 'bool', 'result' => true], 200);
        }
        return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
    }

    /**
    * @Rest\Get("/api/profil/view")
    */
    public function viewProfilAction (Request $request)
    {
        $auth = new AuthentificationManager($this->getDoctrine());
        if(
            $auth->checkApiUserCredential($request->query->get('apikey'), $request->query->get('secret'))
        ) {
            $id = $auth->getUserId();
            $em = $this->getDoctrine()->getManager()->createQueryBuilder();
            $user = $em->select('u.username, u.email, u.birthday, u.mobile, u.name, u.zipCode, u.address')
                ->from('coreBundle:WebsiteStyxuserbase', 'u')
                ->where('u.id = ?1')
                ->setParameter(1, $id)
                ->getQuery()
                ->getArrayResult();
            return new JsonResponse(['success' => true, 'resultType' => 'int', 'result' => $user], 200);
        }
        return new JsonResponse(['success' => false, 'codeError' => 403, 'message' => "You are not indified"], 403);
    }
    /**
    * encode the password
    * @param  string $password Clear password
    * @param  string $salt     The salt, stock in DB
    * @return string           The crypt password
    */
    private  function encodePassword ($password, $salt)
    {
      $salted = $password.'{'.$salt.'}';
      $digest = hash($this->algo, $salted, true);

      for ($i=1; $i<5000; $i++) {
          $digest = hash($this->algo, $digest.$salted, true);
      }

      return base64_encode($digest);
    }

    private function createSalt()
    {
      return hash('sha512', uniqid()."NMCAECTMD");
    }

    private function verifpassword ($pwd, $hash, $salt)
    {
        return $hash === $this->encodePassword($pwd, $salt);
    }

    private function generateApiSecret ()
    {
      return hash('sha512', base64_encode(uniqid().rand()));
    }

}
