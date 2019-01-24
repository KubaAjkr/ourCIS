<?php

namespace AppBundle\Controller;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GanttController extends Controller
{
   /**
   * @Route("/gantt", name="gantt")
   */
    public function showAction(Request $request)
    {
       
    if (!$this->getUser()){
        return $this->redirectToRoute('login');
    }
        return $this->render('gantt/gantt.html.twig', array('abc' => NULL));
    }
}