<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilEtudiantController extends Controller
{
    public function indexAction()
    {
        return $this->render('websiteBundle:profil/student:profil.html.twig');
    }
}
