<?php

namespace AppBundle\Controller;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
   /**
   * @Route("/", name="main")
   */
    public function showAction(Request $request)
    {
       
    if (!$this->getUser()){
        return $this->redirectToRoute('login');
    }
        return $this->render('default/index.html.twig', array('aaa' => NULL));
    }
}