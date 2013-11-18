<?php

namespace NKN\BlogBundle\Controller;

use NKN\BlogBundle\Controller\Common\MainController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends MainController
{
    /**
     * @Route("/")
     * @Template("NKNBlogBundle:Index:index.html.twig")
     */
    public function indexAction()
    {
        return
            ['content' => 'Some fucking content!!!!',
             'menu_array' => [[
                 'name'=>'b2la',
                 'href'=>'#',
                 'active'=>0
             ],[
                 'name'=>'fasf',
                 'href'=>'#',
                 'active'=>1
             ],
                 [
                     'name'=>'gdshsh',
                     'href'=>'#',
                     'active'=>false
                 ],]
            ];
    }

}
