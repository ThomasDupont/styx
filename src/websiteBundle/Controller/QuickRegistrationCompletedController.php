<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class QuickRegistrationCompletedController extends Controller
{
    public function indexAction()
    {
        return $this->render('websiteBundle:quick_registration:complete_registration.html.twig');
    }
}
