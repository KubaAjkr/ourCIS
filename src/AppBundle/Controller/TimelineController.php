<?php

namespace AppBundle\Controller;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TimelineController extends Controller
{
   /**
   * @Route("/timeline", name="timeline")
   */
    public function showAction(Request $request)
    {
       
    if (!$this->getUser()){
        return $this->redirectToRoute('login');
    }
        return $this->render('other/timeline.html.twig', array('bbb' => NULL));
    }
}