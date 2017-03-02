<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class QuickRegistrationController extends Controller
{
    public function indexAction()
    {
        return $this->render('websiteBundle:quick_registration:quick_registration.html.twig');
    }
}
