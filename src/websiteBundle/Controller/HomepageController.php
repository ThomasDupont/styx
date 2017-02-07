<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function indexAction()
    {
        return $this->render('websiteBundle:homepage:homepage.html.twig');
    }
    public function resetPasswordAction()
    {
        return $this->render('websiteBundle:homepage:password_reset.html.twig');
    }
}
