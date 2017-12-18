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
    public function showAction(Request $request) { {
            //$productId = 1;
            //$zaznam = $this->getDoctrine()
            //    ->getRepository(Tree::class)
            //    ->find($productId);

            $contract = 771;

            $em = $this->getDoctrine()->getManager();

            $RAW_QUERY = 'SELECT item.id, item.contract_id, item.name, user.username, item.type_id, item.upper_id, item.variant_id FROM item LEFT JOIN user ON item.user_id = user.id where item.contract_id = ' . $contract . ';';

            $statement = $em->getConnection()->prepare($RAW_QUERY);
            $statement->execute();

            $zaznam = $statement->fetchAll();
            $row_contract = $statement->rowCount();

            $RAW_QUERY = 'SELECT ROW_COUNT() FROM item;';

            $statement = $em->getConnection()->prepare($RAW_QUERY);
            $statement->execute();

            $row_item = $statement->rowCount();


            if (!$zaznam) {
                throw $this->createNotFoundException(
                        'Nic nenalezeno!'
                );
            }

            // ... do something, like pass the $product object into a template
        }

        return $this->render('list/list.html.twig', array(
                    'ABC' => $zaznam,
                    'contract' => $contract,
                    'row_contract' => $row_contract,
                    'row_item' => $row_item
        ));
        //return $this->render('list/list.html.twig', array('item' => new Item('1','jméno'));
    }

}
