<?php

namespace NKN\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NKNBlogBundle:Default:index.html.twig',
            ['content' => 'Some fucking content!!!!']);
    }
}
