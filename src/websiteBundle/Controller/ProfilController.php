<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller
{
    public function studentAction()
    {
        return $this->render('websiteBundle:profil/student:profil.html.twig');
    }

    public function associationAction()
    {
        return $this->render('websiteBundle:profil/association:profil.html.twig');
    }

    public function updateAction()
    {
        return $this->render('websiteBundle:profil:update_profil.html.twig');
    }
}
