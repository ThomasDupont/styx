<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\WebsiteStyxuserbaseZones;
use FOS\UserBundle\Controller\RegistrationController as RegistrationControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegistrationController extends RegistrationControllerBase
{
    public function registerAction()
    {
        $response = parent::registerAction();

        if ($response instanceof RedirectResponse) {
            $response = new RedirectResponse('/feed');
            $form = $this->container->get('fos_user.registration.form');
            $user = $form->getData();
            $zone = $user->getCity();
            $em = $this->container->get('doctrine')->getManager();
            $query = $em->createQuery('
            SELECT wg
            FROM coreBundle:WebsiteGroup wg
            WHERE wg.id = :id
            ')
                ->setParameter('id', 1);
            $group = $query->getResult();

            $styxuserbaseZones = new WebsiteStyxuserbaseZones();
            $styxuserbaseZones->setStyxuserbase($user);
            $styxuserbaseZones->setZone($zone);
            $em->persist($styxuserbaseZones);
            $em->flush();

            $repositoryStyxuserbase = $this->container->get('doctrine')->getRepository('coreBundle:WebsiteStyxuserbase');
            $idUser = $this->container->getUser()->getId();
            $user = $repositoryStyxuserbase->findById($idUser)[0];


            //var_dump($group);
            //exit;
        }

        return $response;
    }
}
