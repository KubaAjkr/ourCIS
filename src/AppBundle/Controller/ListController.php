<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use AppBundle\Entity\User;
use AppBundle\Entity\Type;
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
                dump("chybné upper_id záznamu " . $item->getId());
            }
        }
    }

    /**
     * @Route("/list", name="list")
     */
    public function showAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        /*
         * Případné naplnění tabulky Item
         * 
         *             
          $user = $this->getDoctrine()
          ->getRepository(User::class)
          ->find(1);

          $type = new Type();
          $type->setCode("TEST");
          $type->setName("Test");

          $bagr = new Item();
          $bagr->setTitle('KR5500Tk');
          $bagr->setContract_id(1);
          $bagr->setType($type);
          $bagr->setUser($user);

          $podvozek = new Item();
          $podvozek->setTitle('Podvozek');
          $podvozek->setParent($bagr);
          $podvozek->setContract_id(1);
          $podvozek->setType($type);
          $podvozek->setUser($user);

          $housenice = new Item();
          $housenice->setTitle('Housenice');
          $housenice->setParent($podvozek);
          $housenice->setContract_id(1);
          $housenice->setType($type);
          $housenice->setUser($user);

          $ss = new Item();
          $ss->setTitle('Spodní stavba');
          $ss->setParent($bagr);
          $ss->setContract_id(1);
          $ss->setType($type);
          $ss->setUser($user);

          $em->persist($user);
          $em->persist($type);
          $em->persist($bagr);
          $em->persist($podvozek);
          $em->persist($housenice);
          $em->persist($ss);
          $em->flush();
         * 
         */

        $contract = 1;
        $this->getDataFromDB($contract);
        


        $repo = $em->getRepository(Item::class);
        $options = array(
            'decorate' => true,
            'rootOpen' => '<ul class="list-group">',
            'rootClose' => '</ul>',
            'childOpen' => '<li class="list-group-item">',
            'childClose' => '</li>',
            'nodeDecorator' => function($node) {
        return '<a href="/">'.$node['title'].'</a>'.$node['type_id'];
    }

            
        );
        $htmlTree = $repo->childrenHierarchy(
                null, /* starting from root nodes */ 
                false, /* false: load all children, true: only direct */ 
                $options
        );


        return $this->render('list/list.html.twig', array(
                    'contract' => $contract,
                    'rows_contract' => 0,
                    'rows_item' => 9999,
                    'XXX' => $this->list,
                    'tree' => $htmlTree
        ));
    }

}
