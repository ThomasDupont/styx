<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConversationController extends Controller
{
    public function indexAction()
    {
        return $this->render('websiteBundle:conversation:conversation.html.twig');
    }
}
