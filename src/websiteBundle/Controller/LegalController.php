<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LegalController extends Controller
{
    public function indexAction()
    {
        return $this->render('websiteBundle:legal:private_policy.html.twig');
    }
}
