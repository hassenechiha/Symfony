<?php

namespace MarsupilamiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MarsupilamiBundle:Default:index.html.twig');
    }


}
