<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventGameController extends Controller
{
    public function indexAction()
    {
        return $this->render('websiteBundle:eventGame:event.html.twig');
    }
}
