<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\SQLParserUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller {

    
    protected $XXX;
    
    private function getDataFromDB($contract) {
        
        $query = $this->get('doctrine')->getManager()
                        ->createQuery(
                                'SELECT i, u FROM AppBundle:Item i
                                JOIN i.user u
                                WHERE i.contract_id = :contractId'
                        )->setParameter('contractId', $contract);

        $this->XXX = $query->getResult(); 
    }
    
    private function setIndentation() {
        
        foreach ($this->XXX as $item) {
            $upper_id = $item->getUpperId();

            if ($upper_id != 0) {
                $upper = $this->getDoctrine()
                        ->getRepository(Item::class)
                        ->find($upper_id);
                $item->setIndentation($upper->getIndentation() + 1);
            } elseif ($upper_id === 0) {
                $item->setIndentation(0);
            } else {
                dump("chybné upper_id záznamu ".$item->getId());
            }
        }
    }
    
    
    /**
     * @Route("/list", name="list")
     */
    public function showAction(Request $request) {

        $contract = 771;
        $this->getDataFromDB($contract);
        $this->setIndentation();

        
        return $this->render('list/list.html.twig', array(
                    'contract' => $contract,
                    'rows_contract' => 0,
                    'rows_item' => 9999,
                    'XXX' => $this->XXX
        ));
    }

}
