<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FeedController extends Controller
{
    public function indexAction()
    {
        return $this->render('websiteBundle:feed:feed.html.twig');
    }
}
