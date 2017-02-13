<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilAssociationController extends Controller
{
    public function indexAciton()
    {
        return $this->render('websiteBundle:profil/association:profil.html.twig');
    }
}
