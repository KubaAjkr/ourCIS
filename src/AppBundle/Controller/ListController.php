<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tree;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller
{
   /**
   * @Route("/list", name="list")
   */
    public function showAction(Request $request)
    {
        $characters = [
          'Daenerys Targaryen' => 'Emilia Clarke',
          'Jon Snow'           => 'Kit Harington',
          'Arya Stark'         => 'Maisie Williams',
          'Melisandre'         => 'Carice van Houten',
          'Khal Drogo'         => 'Jason Momoa',
          'Tyrion Lannister'   => 'Peter Dinklage',
          'Ramsay Bolton'      => 'Iwan Rheon',
          'Petyr Baelish'      => 'Aidan Gillen',
          'Brienne of Tarth'   => 'Gwendoline Christie',
          'Lord Varys'         => 'Conleth Hill'
        ];
        
   
{
    $productId = 1;
    $zaznam = $this->getDoctrine()
        ->getRepository(Tree::class)
        ->find($productId);

    if (!$zaznam) {
        throw $this->createNotFoundException(
            'No product found for id '.$productId
        );
    }

    // ... do something, like pass the $product object into a template
}

        return $this->render('list/list.html.twig', array('ABC' => $zaznam));
        //return $this->render('list/list.html.twig', array('tree' => new Tree('1','jméno'));
 
    }
}