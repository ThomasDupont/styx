<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use coreBundle\Entity\WebsiteStyxuserbase;

class SearchController extends Controller
{
    public function indexAction(Request $request)
    {
      $param = $request->request->get("result");
      $em = $this->getDoctrine()->getManager();
      $query = $em->createQuery('
        SELECT w
        FROM coreBundle:WebsiteStyxuserbase w
        WHERE w.name LIKE :coucou
        ')
        ->setParameter('coucou', $param."%");
      $res = $query->getResult();

      // for ($i=0; $i < sizeof($res); $i++) {
      //   var_dump($res[$i]->getName());
      // }

      // exit;
      // $user = $repositoryStyxuserbase->findCOUCOUByName()[0];

      // if($user) {
      //   var_dump($user->getName());
      // } else {
      //   var_dump(null);
      // }
      // var_dump(@$user->getName());
      // var_dump($request->request->get("result"));
      // exit;
      return $this->render('websiteBundle:search:search.html.twig', array(
          'search_result' => $res,
      ));
    }
}
