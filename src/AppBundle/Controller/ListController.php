<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use AppBundle\Entity\Category;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ListController extends Controller {

    
    private $list;
    private $em;
    
    
    private function getDataFromDB($contract) {
              
        $query = $this->get('doctrine')->getManager()
                        ->createQuery(
                                'SELECT i, u FROM AppBundle:Item i
                                JOIN i.user u
                                WHERE i.contract_id = :contractId '                              
                        )->setParameter('contractId', $contract);

        $this->list = $query->getResult(); 
    }
    
    private function setIndentation() {
        
        foreach ($this->list as $item) {
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
        
        $this->em = $this->getDoctrine()->getManager();
        
        if ($this->get('session')->get('vykresleno') === NULL) {
            
            
            
            $food = new Category();
            $food->setTitle('Food');

            $fruits = new Category();
            $fruits->setTitle('Fruits');
            $fruits->setParent($food);

            $vegetables = new Category();
            $vegetables->setTitle('Vegetables');
            $vegetables->setParent($food);

            $carrots = new Category();
            $carrots->setTitle('Carrots');
            $carrots->setParent($vegetables);

            $this->em->persist($food);
            $this->em->persist($fruits);
            $this->em->persist($vegetables);
            $this->em->persist($carrots);
            $this->em->flush();
            
            $this->get('session')->set('vykresleno', TRUE);
        }

        
        

 
        $contract = 771;
        $this->getDataFromDB($contract);
        $this->setIndentation();

        
        return $this->render('list/list.html.twig', array(
                    'contract' => $contract,
                    'rows_contract' => 0,
                    'rows_item' => 9999,
                    'XXX' => $this->list
        ));
    }
}
