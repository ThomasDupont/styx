<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ResetPasswordController extends Controller
{
    public function indexAction()
    {
        return $this->render('websiteBundle:homepage:password_reset.html.twig');
    }
}