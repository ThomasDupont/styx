<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use coreBundle\Entity\WebsiteStyxuserbase;

class SearchController extends Controller
{
    public function indexAction(Request $request)
    {
      $repositoryStyxuserbase = $this->getDoctrine()->getManager()->getRepository('coreBundle:WebsiteStyxuserbase');
      $user = $repositoryStyxuserbase->findCOUCOUByName($request->request->get("result"))[0];

      if($user) {
        var_dump($user->getName());
      } else {
        var_dump(null);
      }
      // var_dump(@$user->getName());
      // var_dump($request->request->get("result"));
      exit;
      return $this->render('websiteBundle:search:search.html.twig');
    }
}
