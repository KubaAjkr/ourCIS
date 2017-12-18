<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tree;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\SQLParserUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller {

    /**
     * @Route("/list", name="list")
     */
    public function showAction(Request $request) { 
            //$productId = 1;
            //$zaznam = $this->getDoctrine()
            //    ->getRepository(Tree::class)
            //    ->find($productId);

            $contract = 771;


        
               $query = $this->get('doctrine')->getManager()
                        ->createQuery(
                                'SELECT i, u FROM AppBundle:Item i
                                JOIN i.user u
                                WHERE i.contract_id = :contractId'
                        )->setParameter('contractId', $contract);



        return $this->render('list/list.html.twig', array(
                    'contract' => $contract,
                    'rows_contract' => 0,
                    'rows_item' => 99999,
                    'XXX' => $query->getResult()
        ));
        //return $this->render('list/list.html.twig', array('item' => new Item('1','jméno'));
    }



}
