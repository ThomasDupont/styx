<?php

namespace websiteBundle\Controller;

use coreBundle\Entity\WebsiteMember;
use coreBundle\Entity\WebsiteSocial;
use coreBundle\Entity\WebsiteStyxuserbase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\HttpFoundation\Request;
use websiteBundle\Form\MemberFormType;
use websiteBundle\Form\SocialFormType;
use websiteBundle\Form\UpdateProfilFormType;
use websiteBundle\Form\EmailNotificationFormType;

class UpdateProfilController extends Controller
{
    public function indexAction(Request $request)
    {
        $repositoryStyxuserbase = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
        $repositorySocial = $this->getDoctrine()->getRepository('coreBundle:WebsiteSocial');
        $repositoryMember = $this->getDoctrine()->getRepository('coreBundle:WebsiteMember');

        $idUser = $this->getUser()->getId();
        $user = $repositoryStyxuserbase->findById($idUser)[0];
        $birthday = $user->getBirthday();
        $city = $user->getCity();
        $emailNotification = $user->getEmailNotification();
        $userMembers = $repositoryMember->findByUser($user);

        $updateProfilForm = $this->createForm(new UpdateProfilFormType(), $user);
        $emailNotificationForm = $this->createForm(new EmailNotificationFormType(), $user);

        if ($updateProfilForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        if ($emailNotificationForm->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

        }

        $group = $repositorySocial->findOneBy(array('entity' => $idUser));
        if (empty($group)) {
            $websiteSocial = new WebsiteSocial();
            $socialForm = $this->createForm(new SocialFormType(), $websiteSocial);
            if ($socialForm->handleRequest($request)->isValid()) {
                $websiteSocial->setEntity($user);
                $em = $this->getDoctrine()->getManager();
                $em->persist($websiteSocial);
                $em->flush();
            }
        } else {
            $socialForm = $this->createForm(new SocialFormType(), $group);
            if ($socialForm->handleRequest($request)->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($group);
                $em->flush();
            }
        }

        $member = new WebsiteMember();
        $memberForm = $this->createForm(new MemberFormType(), $member);
        if ($memberForm->handleRequest($request)->isValid()) {
            $member->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();
        }

        if ($request->getMethod() == 'POST') {
            if ($emailNotificationForm->isSubmitted() && $emailNotificationForm->isValid()) {
                $user->setBirthday($birthday);
                $user->setCity($city);$em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            } else if ($updateProfilForm->isSubmitted() && $updateProfilForm->isValid()) {
                $user->setEmailNotification($emailNotification);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            }
            return $this->redirect($this->generateUrl($request->get('_route'), $request->query->all()));
        }

        return $this->render('websiteBundle:profil:update_profil.html.twig', array(
            'updateProfilForm' => $updateProfilForm->createView(),
            'emailNotificationForm' => $emailNotificationForm->createView(),
            'updateSocial' => $socialForm->createView(),
            'memberForm' => $memberForm->createView(),
            'user' => $user,
            'members' => $userMembers
        ));
    }
}
