<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\WebsiteZone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use websiteBundle\Form\CityFormType;

class AgendaController extends Controller
{
    public function indexAction(Request $request)
    {
        $ville = new WebsiteZone();
        $cityForm = $this->createForm(new CityFormType(), $ville);
        if ($cityForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();
        }

        return $this->render('websiteBundle:feed:agenda.html.twig', array(
            'cityForm' => $cityForm->createView(),
        ));
    }
}
