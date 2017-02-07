<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AgendaController extends Controller
{
    public function agendaAction()
    {
        return $this->render('websiteBundle:feed:agenda.html.twig');
    }
}
