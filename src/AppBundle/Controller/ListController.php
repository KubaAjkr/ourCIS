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

            $RAW_QUERY = 'SELECT tree.id, tree.contract_id, tree.name, user.username, tree.type_id, tree.upper_id, tree.variant_id FROM tree LEFT JOIN user ON tree.user_id = user.id where tree.contract_id = ' . $contract . ';';

            $statement = $em->getConnection()->prepare($RAW_QUERY);
            $statement->execute();

            $zaznam = $statement->fetchAll();
            $row_contract = $statement->rowCount();

            $RAW_QUERY = 'SELECT ROW_COUNT() FROM tree;';

            $statement = $em->getConnection()->prepare($RAW_QUERY);
            $statement->execute();

            $row_tree = $statement->rowCount();


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
                    'row_tree' => $row_tree
        ));
        //return $this->render('list/list.html.twig', array('tree' => new Tree('1','jméno'));
    }

}
