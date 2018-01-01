<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

use AppBundle\Entity\Item;
use AppBundle\Entity\User;
use AppBundle\Entity\Type;

class ImportController extends Controller {

    private $spreadsheet;
    private $root;
    private $parent;
    private $lastItem;
    private $user;
    private $em;
    private $layer; //úroveň položky v RZ
    
    public $error;
    
    const COLUMN_TYPE = 270;
    const COLUMN_TITLE = 260;

    /**
     * @Route("/import", name="import")
     */
    public function importAction(Request $request) {
        $this->user = $this->getUser();
        $this->em = $this->getDoctrine()->getManager();
        
        $form = $this->createFormBuilder()
                ->add('file', FileType::class, array('label' => 'Rozpad zakázky (.xlsx file) - podporována pouze verze 14'))
                ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //$file = $form['file']->getData();
            $NewFilename = 'lastImport.xlsx';
            $dir = './ImportFiles/';
            //$file->move($dir, $file->getClientOriginalName());
            $form['file']->getData()->move($dir, $NewFilename);


            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
            $reader->setLoadAllSheets();
            $reader->setReadDataOnly(true);

            $this->spreadsheet = $reader->load($dir . $NewFilename);
            $this->spreadsheet->setActiveSheetIndex(0);
            //$spreadsheet->setActiveSheetIndexByName('DataSheet');
            $verRZ = $this->spreadsheet->getActiveSheet()->getCell('D3')->getValue();
            
            $column = self::COLUMN_TITLE;
            $row = 18;

            if ($verRZ <> 14) {
                $this->error = "Je podporována pouze verze 14 Rozpadu zakázky!";
            } else {
                $this->spreadsheet->setActiveSheetIndex(3);
                
                $this->root = $this->getItem($column, $row, NULL);//TODO začlenit vlastní fce
                $this->parent = $this->root;
                $this->layer = 1;

                while ($this->spreadsheet->getActiveSheet()
                        ->getCellByColumnAndRow(self::COLUMN_TITLE-3, $row)
                        ->getCalculatedValue() <> "") {
                    $row = $row + 1;
                    $i = 0;
                    if ($this->spreadsheet->getActiveSheet() //pokud za root následuje zase root
                                ->getCellByColumnAndRow(self::COLUMN_TITLE, $row)
                                ->getValue() <> "") {
                                    $this->root = $this->getItem($column, $row, NULL);
                                    $this->parent = $this->root;
                                    $this->layer = 1;
                            }
                    else {
                        while($this->spreadsheet->getActiveSheet()
                            ->getCellByColumnAndRow($column+$i, $row)
                            ->getValue() === NULL) {
                                $i++;
                            }                              
                                $lastLayer = $this->lastItem->getLvl() + 1;

                                $layer = $i + 1;
                                $diff = $layer - $lastLayer;
                                dump($i);
                                dump($diff);
                                if ($diff === 1) {
                                    $this->parent = $this->lastItem;
                                    //throw $this->createNotFoundException('STOP');
                                }elseif ($diff === 0) {
                                    $this->parent = $this->lastItem->getParent();
                                }elseif ($diff < 0) {
                                    $this->parent = $this->lastItem->getParent();
                                    $diff = $diff * (-1);
                                    while ($diff > 0) {
                                        $this->parent = $this->parent->getParent();
                                        $diff--;
                                    }
                                }else {
                                    throw $this->createNotFoundException(
                                        'Nenávazná položka RZ !'.$i." ".$row
                                    );
                                }
                                //dump($this->parent);
                                
                                $this->getItem($column + $i, $row, $this->parent);
                    }
                }                
                return $this->redirectToRoute('list');
                
            }           
        }

        return $this->render('other/import.html.twig', array(
                    'form' => $form->createView(),
                    'error' => $this->error,
        ));
    }
    
    /*
     * vyplní strukturu položku Item z konkrétních souřadnic Xmls
     */
    protected function getItem($col, $row, $parent) {
                $item = new Item();
                $item->setTitle($this->spreadsheet->getActiveSheet()->
                        getCellByColumnAndRow($col, $row)->getValue());
                $type = $this->getDoctrine()->getRepository(Type::class)->
                        findOneBy(array('code' =>$this->spreadsheet->getActiveSheet()
                    ->getCellByColumnAndRow(self::COLUMN_TYPE, $row)->getValue()));
                
                if (!$type) {
                    throw $this->createNotFoundException(
                            'Nenalezen typ ' . $type
                    );
                }
                $item->setType($type);
                $item->setUser($this->user);
                $item->setGrouper("0");
                $item->setContract_id(1);//TODO
                $item->setParent($parent);
                $this->em->persist($this->user);
                $this->em->persist($type);
                $this->em->persist($item);
                $this->em->flush();
                $this->lastItem = $item;
                return $item;   
    }
    
    /*
     * nastavení entity User podle aktuálního uživatele
     */
    protected function getUser() {
        return $this->getDoctrine()
        ->getRepository(User::class)
        ->find(1); //TODO
    }

    /*
     * Naplní tabulku Type z rozpadu
     */

    public function flushType() {

        $form = $this->createFormBuilder()
                ->add('file', FileType::class, array('label' => 'Rozpad zakázky (.xlsx file) - podporována pouze verze 14'))
                ->getForm();

        //$form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //$file = $form['file']->getData();
            $NewFilename = 'lastImport.xlsx';
            $dir = './ImportFiles/';
            //$file->move($dir, $file->getClientOriginalName());
            $form['file']->getData()->move($dir, $NewFilename);


            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
            $reader->setLoadAllSheets();
            $reader->setReadDataOnly(true);

            $spreadsheet = $reader->load($dir . $NewFilename);
            $spreadsheet->setActiveSheetIndex(0);
            //$spreadsheet->setActiveSheetIndexByName('DataSheet');
            $verRZ = $spreadsheet->getActiveSheet()->getCell('D3')->getValue();

            if ($verRZ <> 14) {
                $this->error = "Je podporována pouze verze 14 Rozpadu zakázky!";
            } else {

                $column = 13;
                $row = 5;
                $spreadsheet->setActiveSheetIndex(2);
                while ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($column, $row)->getValue() <> "") {
                    $type = new Type();
                    $type->setName($spreadsheet->getActiveSheet()->getCellByColumnAndRow($column, $row)->getValue());
                    $type->setDescription($spreadsheet->getActiveSheet()->getCellByColumnAndRow($column + 1, $row)->getValue());
                    $type->setCode($spreadsheet->getActiveSheet()->getCellByColumnAndRow($column + 2, $row)->getCalculatedValue());
                    $this->em->persist($type);
                    $this->em->flush();
                    $row = $row + 1;
                }
            }
                    return $this->render('other/import.html.twig', array(
                    'form' => $form->createView(),
                    'error' => $this->error,
                        ));
        }
    }

}
