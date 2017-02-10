<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UpdateProfilController extends Controller
{
    public function indexAction()
    {
        return $this->render('websiteBundle:profil:update_profil.html.twig');
    }
}
