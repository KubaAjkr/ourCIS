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

            $contract = 771;

               $query = $this->get('doctrine')->getManager()
                        ->createQuery(
                                'SELECT i, u FROM AppBundle:Item i
                                JOIN i.user u
                                WHERE i.contract_id = :contractId'
                        )->setParameter('contractId', $contract);
               
               $XXX = $query->getResult();
               
               foreach($XXX as $item) {
                   $upper_id = $item->getUpperId();
                   dump($upper_id);
                   foreach($XXX as $ite) {
                       if ($ite->getId() === $upper_id) {
                           $item->setIndentation($ite->getIndentation()+1);
                           dump($item->getIndentation());
                       }
                   }         
               }
        return $this->render('list/list.html.twig', array(
                    'contract' => $contract,
                    'rows_contract' => 0,
                    'rows_item' => 9999,
                    'XXX' => $XXX
        ));
    }
}
