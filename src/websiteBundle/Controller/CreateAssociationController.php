<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CreateAssociationController extends Controller
{
    public function indexAction()
    {
        return $this->render('websiteBundle:association:create_association.html.twig');
    }
}
